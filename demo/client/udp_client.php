<?php
//udp 客户端 demo
$client = new swoole_client(SWOOLE_SOCK_UDP);

if(!$client->connect('127.0.0.1',9502)) {
    echo 'udp服务连接错误';
    exit;
}

//php cli常量
fwrite(STDOUT,"请输入消息:");

$msg = trim(fgets(STDIN));

//send 发送消息
$client->send($msg);

$result = $client->recv();

echo $result;

