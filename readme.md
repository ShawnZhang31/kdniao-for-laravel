##快递鸟,快递查询
###安装
```sh
composer require shawn/kdniao
```
###配置
在.env文件中添加
```sh
KDNIAO_EBUSSINESSID=
KDNIAO_APPKEY=
```
在config/app.php中注册服务
```sh
Shawn\Kdniao\KdniaoServiceProvider::class,
'Kdniao'=>Shawn\Kdniao\Facades\Kdniao::class,
```
###使用
```sh
return Kdniao::getOrderTraces('HHTT','580334019453');
```
```sh
返回数据为:
{
"EBusinessID": "1272627",
"ShipperCode": "HHTT",
"Success": true,
"LogisticCode": "580334019453",
"State": "3",
"Traces": [
{
"AcceptTime": "2016-12-15 19:09:33",
"AcceptStation": "湖州安吉(0572-5026810，0572-5026710)的公司已收件，扫描员是程祥宏"
},
{
"AcceptTime": "2016-12-15 19:10:01",
"AcceptStation": "快件由湖州安吉(0572-5026810，0572-5026710)发往广州分拨中心"
},
{
"AcceptTime": "2016-12-17 02:29:43",
"AcceptStation": "快件由广州分拨中心发往广州天河仓"
},
{
"AcceptTime": "2016-12-17 04:52:38",
"AcceptStation": "快件由广州分拨中心发往广州珠村分部(020-62119019)"
},
{
"AcceptTime": "2016-12-17 08:32:25",
"AcceptStation": "快件到达广州珠村分部(020-62119019)，上一站是广州分拨中心扫描员是广州珠村"
},
{
"AcceptTime": "2016-12-17 23:54:41",
"AcceptStation": "广州珠村分部(020-62119019)已进行货件留仓扫描"
},
{
"AcceptTime": "2016-12-18 22:09:24",
"AcceptStation": "广州珠村分部(020-62119019)已进行货件留仓扫描"
},
{
"AcceptTime": "2016-12-19 20:53:53",
"AcceptStation": "广州珠村分部(020-62119019)的欧阳萧13710121356正在派件"
},
{
"AcceptTime": "2016-12-19 21:45:02",
"AcceptStation": "广州珠村分部(020-62119019)已进行货件留仓扫描"
},
{
"AcceptTime": "2016-12-19 22:05:22",
"AcceptStation": "广州珠村分部(020-62119019)的欧阳萧13710121356正在派件"
},
{
"AcceptTime": "2016-12-19 22:17:36",
"AcceptStation": "快件已签收,签收人是朋友"
}
]
}
```