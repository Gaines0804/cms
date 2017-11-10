<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\middleware\Middleware;

class Common extends Controller{
    //构建构造方法，执行中间件
    public function __construct()
    {
        //Middleware::set('check',['only'=>['lists']]);
        //执行中间件，除了login、logout不需要执行检测之外，其他的都需要检测，因为退出和登录这两个状态下，本身就没有登录
        Middleware::set('check',['except'=>['login','logout']]);
    }
}
