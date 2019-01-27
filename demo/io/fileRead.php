<?php

//PHP_EOL 根据不同的操作系统分配换行符
swoole_async_readfile(__DIR__.'/1.txt',function ($filename,$fileContent) {
    echo 'filename is '.$filename.PHP_EOL.',fileContents is '.$fileContent.PHP_EOL;
});