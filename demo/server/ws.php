<?php
//websocket 面向对象
class ws
{
    private $server;

    public function __construct ()
    {
        $this->server = new Swoole\WebSocket\Server('0.0.0.0',9503);

        $this->server->set([
            'enable_static_handler'=>true,
            'document_root'=>'/var/www/html/swoole_test/data'
        ]);

        $this->server->on('open',[$this, 'openFunc']);

        $this->server->on('message',[$this, 'messageFunc']);

       /* $this->server->on('Task',[$this, 'OnTask']);

        $this->server->on('Finish',[$this, 'OnFinish']);*/

        $this->server->on('close',[$this, 'closeFunc']);

        $this->server->on('request',[$this, 'resqFunc']);

        $this->server->start();
    }

    public function openFunc (swoole_websocket_server $server,$request)
    {
        echo "server: handshake success with fd{$request->fd}\n";

        //swoole_timer_tick swoole毫秒定时器
       /* swoole_timer_tick(1000,function() {
            echo 'hello world';
        });*/
    }

    public function messageFunc (Swoole\WebSocket\Server $server,$frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

        //异步的 use php闭包 连接闭包与外界的关键字use
        swoole_timer_after(5000,function () use ($server,$frame) {
            $server->push($frame->fd, "5 secode i am coming");
        });
        $server->push($frame->fd, "this is server");

        $data = '时间：'.date('Y-m-d H:i:s').'发生this is server，给:'.$frame->fd;
        Swoole\Async::writeFile(__DIR__.'/log.txt',$data,function () {

        },FILE_APPEND);
        /*swoole_timer_after(3000,function () {
            echo 'hello hello world';
        });*/
    }

    public function closeFunc ($ser, $fd)
    {
        echo "client {$fd} closed\n";
    }

    public function resqFunc ($request, $response)
    {
        foreach ($this->server->connections as $fd) {
            $this->server->push($fd, $request->get['message']);
        }
    }
}

new ws();