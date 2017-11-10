<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;

class Check implements Middleware{
	//执行中间件
	public function run($next) {
	    //如果session不存在，那么说明没有登录
        //提示用户需要先登录，跳转到登录页面
        if(!Session::get('user')){
            //执行message函数，函数可以很多地方调用
            //这里不能使用对象调用的方法跳转，因为没有对象可以执行对应的方法
            return message('请先登录',__ROOT__ . '/login');
        }
         $next();
	}
}