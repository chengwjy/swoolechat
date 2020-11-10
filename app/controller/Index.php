<?php
namespace app\controller;

use app\BaseController;
// use \think\Facade\View;
class Index extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
