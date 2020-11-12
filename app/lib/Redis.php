<?php

declare (strict_types = 1);
namespace app\lib;
use Exception;

class Redis extends \Redis{
    public function __construct()
    {
        try{
            $this->connect(config('redis.host'), config('redis.port'));
        }catch(Exception $e){
            throw new Exception('redis连接失败');
        }
    }
}