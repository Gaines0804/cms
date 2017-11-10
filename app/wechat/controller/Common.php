<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use houdunwang\middleware\Middleware;

class Common extends Controller{
    //动作
    public function __construct(){
        //使用中间件验证是否登陆
        Middleware::set('check');
    }
}
