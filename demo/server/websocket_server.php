<?php
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);

$server->set([
    'enable_static_handler'=>true,
    'document_root'=>'/var/www/html/swoole_test/data'
]);

//onHandShaket 可选 websocket 建立连接后握手  websoket已内置handshaket
//onOpen 可选 websocket 客户端与服务端建立连接并完成握手后，调用onOpen
$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    print_r($request->fd);
    echo "server: handshake success with fd{$request->fd}\n";
});

//onMessage 必选 当服务端接受到来自客户端的数据时会回调此函数
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

//onClose 关闭连接
$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();