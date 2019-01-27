<?php
//http server的demo
$http = new Swoole\Http\Server('0.0.0.0',9527);

$http->set([
    'enable_static_handler'=>true,
    'document_root'=>'/var/www/html/swoole_test/data'
]);

$http->on('request',function ($request,$response) {
    /*print_r($request->get);*/
    //request 设置cookie
   /* $request->cookie('zhang','1234',time()+1000);*/

    //response 设置cookie
   /* $response->cookie('zhangjun','hello world',time()+3600);*/
    $response->end("参数:".json_encode(($request->get))."<h1>HttpServer #".rand(1111,9999)."</h1>");
});

$http->start();