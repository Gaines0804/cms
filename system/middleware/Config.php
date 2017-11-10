<?php
namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config as configModel;

class Config implements Middleware{
	//执行中间件
	public function run($next) {
	    //判断是否已经安装过，我们需要执行安装过程，所以这里如果get参数存在安装相关的方法就不执行中间件，否则就执行
        if(!is_file('lock.php') && !preg_match('#system/install#',Request::get('s'))){
            //如果没有安装那么就去执行copyright方法
            go('system.install.copyright');
        }


        if(is_file('lock.php')) {
            //如果执行了备份控制器backup，就不需要执行中间件，因为我们可能会把数据表全部删除，数据表中包含有config表，全局中间件会查询config表中的数据，那么查询不到就会报错
            if (CONTROLLER != 'backup') {
                $model = configModel::find(1);
                //如果能够查询到数据，那么就执行if里面的代码
                if ($model) {
                    //获得配置项中的数据
                    //这里运用了pluck获得指定字段的数据
                    $data = $model->pluck('content');
                    //获得一个json对象的数据
                    //p($data);
                    v('config', json_decode($data, true));
                }
            }
        }


        //组合模板路径
        $template = 'template/' . ( IS_MOBILE ? 'mobile' : 'web' );
        //定义静态资源常量
        define( '__TEMPLATE__', __ROOT__ . '/' . $template );
        define( 'TEMPLATE',  $template );
        //echo TEMPLATE;

        $next();
	}
}