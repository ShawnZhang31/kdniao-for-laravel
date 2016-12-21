<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaomin
 * Date: 2016/12/21
 * Time: 上午9:48
 */

namespace Shawn\Kdniao;


class Kdniao
{
    /**
     * @var 商户id
     */
    protected $ebussionsid;

    /**
     * @var appkey
     */
    protected $appkey;

    /**
     * Kdniao constructor.
     * @param $ebussionid
     * @param $appkey
     */
    public function __construct()
    {
        $this->ebussionsid=env('KDNIAO_EBUSSINESSID','');
        $this->appkey=env('KDNIAO_APPKEY','');
    }

    /**
     * @param $requestData, json类型,提交的数据,{'OrderCode':'','ShipperCode':'SF','LogisticCode':'589707398027'},OrderCode:订单编号,选填;ShipperCode:快递公司编号;LogisticCode:物流单号
     * @return string
     */
    public function getOrderTracesByJson($requestData)
    {

        if (!$this->is_not_json($requestData))
        {
            return '$requestData,必须是json类型';
        }

        $datas=array(
            'EBusinessID'=>$this->ebussionsid,
            'RequestType'=>'1002',
            'RequestData'=>urlencode($requestData),
            'DataType'=>'2',
        );

        $datas['DataSign']=$this->encrypt($requestData);
        $result=$this->sendTracesPost($datas);

        return $result;
    }

    /**
     * 判断时候为json类型
     * @param $str
     * @return bool
     */
    private function is_not_json($str)
    {
        return is_null(json_decode($str));
    }

    /**
     * post提交既是查询的请求
     * @param $datas
     * @return string,
     */
    private function sendTracesPost($datas)
    {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url("http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx");
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商sign签名
     * @param $data
     * @return string, DataSign签名
     */
    private function encrypt($data)
    {
        return urlencode(base64_encode(md5($data.$this->appkey)));
    }
}