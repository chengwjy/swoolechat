<?php
declare (strict_types = 1);
namespace app\lib;
use \Swoole\WebSocket\Server as SWServer;
class Server
{
    public function __construct()
    {
        $redis = new \app\lib\Redis();
        //创建WebSocket Server对象，监听0.0.0.0:9501端口
        $ws = new SWServer('0.0.0.0', 9501);

        //监听WebSocket连接打开事件
        $ws->on('open', function ($ws, $request){
           
        });

        //监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) use ($redis) {
            $receive_data = json_decode($frame->data, true);
            // 注册
            if($receive_data['type'] == '1'){
                $redis->set('fd_'.$frame->fd, $frame->fd);

            }else{
                $collections = $redis->keys('fd_*');
                $data = ['type' => '2', 'msg' => $receive_data['msg']];
              
                foreach($collections as $v){
                    $id = $redis->get($v);
                    if($id){
                        $ws->push((int)$id, json_encode($data));
                    }
                }
            }
        });

        //监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd)use ($redis) {
            
        });

        $ws->start();
        // // 指令输出
        // $output->writeln('websocket');
    }
}
