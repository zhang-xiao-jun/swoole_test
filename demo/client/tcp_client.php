<?php
//实例化swoole客户端
$client = new swoole_client(SWOOLE_SOCK_TCP);

//client 连接
if(!$client->connect('127.0.0.1',9501)) {
    echo '连接失败';
    exit;
}

//php cli常量
fwrite(STDOUT,'请输入消息:');
$msg = trim(fgets(STDIN));

//发送消息给tcp server 服务端
$client->send($msg);

//recv 接受服务端返回的信息
$result = $client->recv(65535,0);

echo $result.'<br/>';


