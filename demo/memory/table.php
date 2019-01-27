<?php

$table = new swoole_table(1024);

$table->column('id',swoole_table::TYPE_INT);
$table->column('name',swoole_table::TYPE_STRING,255);
$table->column('age',swoole_table::TYPE_FLOAT);

$table->create();

//
$table->set('test1',['id'=>1,'name'=>'zhangjun','age'=>26]);

/*$table->incr('test1','age',5);*/
$table->decr('test1','age',6);

$table['test2'] = ['id'=>2,'name'=>'hello world','age'=>'777'];

/*$data = $table->get('test2');*/
$data = $table['test1'];
var_dump($data);