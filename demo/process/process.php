<?php

$process = new swoole_process(function (swoole_process $process) {
    //执行一个外部程序
    //第一个参数是php命令程序的绝对路径地址，第二个参数是数值，参数列表
    $process->exec('/usr/bin/php',['/var/www/html/swoole_test/demo/server/http_server.php']);
},true);

//执行fork系统调用，启动进程 返回子进程的pid
$pid = $process->start();
echo $pid.PHP_EOL;

//回收结束运行的子进程
swoole_process::wait();
/*usleep(3000);


echo $process->read();*/

