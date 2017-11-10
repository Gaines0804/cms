<?php namespace app\admin\controller;

use houdunwang\middleware\Middleware;
use houdunwang\view\View;

class Entry extends Common {

    //调用中间件检测是否登录
    public function __construct(){
        if(!Session::get('user')){
            //执行message函数，函数可以很多地方调用
            //这里不能使用对象调用的方法跳转，因为没有对象可以执行对应的方法
            return message('请先登录',__ROOT__ . '/login');
        }
    }

    //后台首页
    public function index(){
        //载入模板
        return View::make();
    }
}
