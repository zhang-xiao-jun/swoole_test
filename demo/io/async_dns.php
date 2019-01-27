<?php
/*swoole_async_dns_lookup("www.baidu.com",function ($host,$ip) {
    echo "{$host} : {$ip}\n";
});*/

swoole_async_set(array(
    'dns_lookup_random'=>true,
));