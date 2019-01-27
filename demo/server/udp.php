<?php
//php udp 服务端的demo
$serv = new swoole_server('127.0.0.1',9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

$serv->set([
    'worker_num'=>4,//worker进程数
    'max_request'=>10000
]);

//监听数据接受事件
$serv->on('Packet',function($serv,$data,$clientInfo) {
    $serv->sendto($clientInfo['address'],$clientInfo['port'],"Server: ".$data);
    var_dump($clientInfo);
});

//启动服务器
$serv->start();
