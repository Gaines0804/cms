<?php
/*--------------------------------------------------------------------------
| 路由规则设置
|--------------------------------------------------------------------------
| 框架支持路由访问机制与普通GET方式访问
| 如果使用普通GET方式访问时不需要设置路由规则
| 当然也可以根据业务需要两种方式都使用
|-------------------------------------------------------------------------*/

Route::get('/admin','app\admin\controller\Entry@index');
Route::any('/login','app\admin\controller\User@login');
//内容页面路由设置
Route::get('/a_{aid}.html','app\home\controller\Entry@content');
//封面页或列表页路由设置
Route::get('/c_{cid}.html','app\home\controller\Entry@lists');
//首页路由设置
Route::get('index.html','app\home\controller\Entry@index');

