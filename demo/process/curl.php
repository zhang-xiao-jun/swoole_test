<?php
//swoole 创建n个子进程来执行
echo 'start_time'.date('Y-m-d H:i:s').PHP_EOL;

$worker = [];
$urls = [
    'http://www.baidu.com',
    'http://www.qq.com',
    'http://www.douyu.com',
    'http://www.xiaomi.com',
    'http://www.ali.com',
    'http://www.jd.com',
    'http://www.wangyi.com',
    'http://www.zhangjun.com',
    'http://www.google.com',
    'http://www.taobao.com'
];

//多进程，同时执行多个程序
for($i=0;$i<count($urls);$i++) {
    //创建子进程
    $process = new Swoole\Process(function (swoole_process $process) use ($i,$urls) {
        $content = curlData($urls[$i]);
        //第二个参数为true时，把文件内容输出到管道里面
        /*echo $content.PHP_EOL;*/
        $process->write($content.PHP_EOL);
    },true);

    $pid = $process->start();
    $worker[$pid] = $process;
}

foreach ($worker as $process) {
    //read 从管道中读取数据
    echo $process->read();
}

echo 'end_time'.date('Y-m-d H:i:s').PHP_EOL;

function curlData ($url)
{
    sleep(1);
    $res = $url.PHP_EOL;
    return $res;
}