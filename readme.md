##快递鸟,快递查询
###安装
```sh
composer require fzaninotto/faker
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
eturn Kdniao::getOrderTracesByJson("{'OrderCode':'','ShipperCode':'HHTT','LogisticCode':'580334019453'}");
```