<?php
//异步读取函数
/*$content = swoole_async_read(__DIR__.'/2.txt',function ($filename,$content) {
    /*echo $content.PHP_EOL;*/
/*});*/

$file_content = 'hello my world';
swoole_async_writefile(__DIR__.'/2.txt',$file_content,function($filename) {
    echo 'write finish'.PHP_EOL;
}, FILE_APPEND);

/*swoole_async_write(__DIR__.'/2.txt','1234',-1,function () {
    echo 'write finish'.PHP_EOL;
});*/

//异步
echo 'test'.PHP_EOL;