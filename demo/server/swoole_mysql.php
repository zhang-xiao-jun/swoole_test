<?php
//swoole 异步连接数据库
$db = new swoole_mysql();

$server = array(
    'host'=>'127.0.0.1',
    'port'=>'3306',
    'user'=>'zhangjun',
    'password'=>'zhangjun123',
    'database'=>'blog57',
    'charset'=>'utf8',
    'timeout'=>3,
);

$db->connect($server,function ($db,$r) {
    if ($r === false) {
        var_dump($db->connect_errno,$db->connect_error);
        die;
    }
    $sql = 'show tables';
    $db->query($sql, function(swoole_mysql $db,$r) {
        if ($r === false) {
            var_dump($db->error,$db->errno);
        } elseif ($r === true) {
            var_dump($db->affected_rows,$db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});