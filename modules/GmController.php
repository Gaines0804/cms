<?php
namespace modules;

use houdunwang\middleware\Middleware;
use houdunwang\route\Controller;
use system\model\Modules;

class GmController extends Controller
{
    //检测是否登录，因为只有登陆了才能操作微信
    public function __construct()
    {
        Middleware::set('check');
    }

    //这里使用公共Wechat，在控制器Wechat中就能使用公共Wechat里面的方法，因为控制器Wechat继承了GmController
    use Wechat;
    /**
     * 载入模版文件
     * 我们不适用之前的View::make方式来载入模板，因为这种方式载入模版回去app目录下找，而我们这里的模版不在app目录下面，所以需要重新定义一个载入模版的方法
     * @param string $tpl
     * @param array $var
     */
    public function display($tpl='',$var=[]){
        //echo 123;
        //m=base&a=controller/wechat/lists(我们以这种参数为例)

        //获得模块名
        //我们需要通过模块名来判断是否为系统模块
        $m = Request::get('m');

        //获得控制器类名和方法名
        //我们需要通过类名和方法名来组合模版路径
        $a = strtolower(Request::get('a'));
        //echo $a; //controller/wechat/lists
        $arr = explode('/',$a);
//        p($arr);
//        Array
//        (
//            [0] => controller
//            [1] => wechat
//            [2] => post
//        )

        //用户有可能自己传入模板，我们还需要判断是否为用户传入的模版
        if(empty($tpl)){
            $method = $arr[2];
        }else{
            $method = $tpl;
        }

        //我们还需要判断是属于外部模块还是系统模块，所以需要获得数据库的内容
        $module = Modules::where('name',$m)->first();
        //p($module->toArray());

        //组合模板路径
        //$template = "modules/base/template/wechat/lists";
        //我们不能固定，需要判断是否为系统模块
        $template = ($module['is_system'] ? 'modules' : 'addons')."/{$m}/template/{$arr[1]}/{$method}";
        //echo $template;
        //检测输出路径modules/base/template/wechat/post
        //echo $template;exit;
        return view($template,$var);
    }
}