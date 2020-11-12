<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\lib\Server;
class Websocket extends Command
{
    protected function configure()
    { 
        // 指令配置 
        $this->setName('websocket')
            ->setDescription('the websocket command');
    }

    protected function execute(Input $input, Output $output)
    {
        new Server();
    }
}
