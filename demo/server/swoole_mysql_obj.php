<?php

//创建swoole_mysql类
class swoole_mysql_obj
{
    private $db = '';
    private $server = '';

    public function __construct ($config)
    {
        $this->db = new swoole_mysql();

        $this->server = array(
            'host'=>$config['host'] ?: '127.0.0.1',
            'port'=>$config['port'] ?: '3306',
            'user'=>$config['user'] ?: 'zhangjun',
            'password'=>$config['password'] ?: 'zhangjun123',
            'database'=>$config['database'] ?: 'blog57',
            'charset'=>$config['charset'] ?: 'utf8',
            'timeout'=>$config['timeout'] ?: 2,
        );


    }

    public function add ()
    {

    }

    public function update ()
    {

    }

    public function select ($id)
    {
        $this->db->connect($this->server, function ($db, $r) use ($id) {
            if ($r === false) {
                var_dump($db->connect_errno, $db->connect_error);
                die;
            }
            $sql = 'select * from users where id='.$id;
            $db->query($sql, function(swoole_mysql $db, $r) {
                if ($r === false) {
                    var_dump($db->error, $db->errno);
                }
                elseif ($r === true ) {
                    var_dump($db->affected_rows, $db->insert_id);
                }
                return $r;
                $db->close();
            });
        });
    }
}
$config = [
    'host'=>'127.0.0.1',
    'port'=>'3306',
    'user'=>'zhangjun',
    'password'=>'zhangjun123',
    'database'=>'blog57',
    'charset'=>'utf8',
    'timeout'=>2,
];

$obj = new swoole_mysql_obj($config);
$res = $obj->select(1);
var_dump($res);