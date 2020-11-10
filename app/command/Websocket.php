<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use \Swoole\WebSocket\Server;
class Websocket extends Command
{
    protected function configure()
    { 
        // 指令配置 
        $this->setName('websocket' )
            ->setDescription('the websocket command');
    }

    protected function execute(Input $input, Output $output)
    {
        //创建WebSocket Server对象，监听0.0.0.0:9501端口
        $ws = new Server('0.0.0.0', 9501);

        //监听WebSocket连接打开事件
        $ws->on('open', function ($ws, $request) {
            var_dump($request->fd, $request->server);
            $ws->push($request->fd, "hello, welcome\n");
        });

        //监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
            echo "Message: {$frame->data}\n";
            $ws->push($frame->fd, "server: {$frame->data}");
        });

        //监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $ws->start();
        // // 指令输出
        // $output->writeln('websocket');
    }
}
