<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use modules\GmController;
use system\model\Article;
use system\model\Category;
use system\model\Modules;
use system\model\Slide;

class Entry extends GmController
{

    public function __construct()
    {

        //处理模块，通过类似下面的get参数访问对应的模块
        //?m=student&a=controller/grade/lists
        $this->runModules();
        //$this->template="template/".(IS_MOBILE?'mobile':'web');

        //echo $this->template;exit;
        //定义静态资源常量
        //define('__TEMPLATE__',__ROOT__ . '/' . $this->template);
        //echo __TEMPLATE__;

    }

    /**
     * 首页面
     * @return mixed
     */
    public function index(){
        //获得轮播图信息
        $slideData = Slide::get();
        //p($slideData->toArray());
        //echo 123;
        //获得栏目数据信息
        $catData = Category::get() ? Category::get()->toArray() : [];
        $arcData = Article::get() ? Article::orderby('time','DESC')->paginate(4) : new Article();

        //echo "http://cms.yanglichao.com/template/web/index.html<br>";
        return $this->display('index.html',compact('catData','slideData','arcData'));
    }


    /**
     * 栏目、列表页
     */
    public function lists(){
        $cid = Request::get('cid');
        $catData = Category::get();
        //p($catData->toArray());
        $model = Category::find($cid);
        $tpl = $model['is_cover'] ? 'cover.html' : 'lists.html';
        //获得文章列表
        $lists = Article::where('category_cid',$cid)->paginate(1);
        return $this->display($tpl,compact('catData','model','lists'));
    }

    /**
     * 内容页
     * @return mixed
     */
    public function content(){
        //获得get参数中的aid
        $aid = Request::get('aid');
        //获得对应的文章数据
        $hdData = Article::find($aid);
        //p($data);
        //获得对应的栏目名称
        $catname = $hdData->category->catname;
        $cid = $hdData->category->cid;
        //处理文章点击次数
        Article::where('aid',$aid)->increment('click',1);
        //将文章的栏目名称存入$hdData中，这样我们直接将hdData数据传输就能在页面获得
        $hdData = $hdData->toArray();
        $hdData['catname']=$catname;
        $hdData['cid']=$cid;
        //p($hdData);
        return $this->display('content.html',compact('hdData'));
    }


    public function runModules(){
        //获得get参数
        $get = Request::get();
        //p($get) ;
//        Array
//        (
//            [m] => student
//            [a] => controller/grade/lists
//        )
        //获得参数中的m值，并转换为小写，因为文件目录为小写
        $m = strtolower($get['m']);
        //echo $m;
        //获得参数中的a值，并转换为小写，我们还需要从中获得控制器类名、方法名
        $a = strtolower($get['a']);
        //echo $a;

        //获得modules数据库中的信息
        $modules = Modules::where('name',$m)->first();
        //p($modules);
        //判断get参数是否存在，如果存在，那么就对参数进行处理，分别获得控制器名、方法名
        if($m && $a && $modules){//说明有参数
            //将$a转换为数组，我们需要从中获得对应的类名和方法名
            //echo 123;
            $arr = explode('/',$a);
            //p($arr);
//            Array
//            (
//                [0] => controller
//                [1] => grade
//                [2] => lists
//            )


            //这里我们不能讲插件文件夹名固定，需要通过数据存储数据来判断，如果is_system为1，说明是系统插件，访问modules目录，否则就是第三方法插件，访问addons目录
            $dir = $modules['is_system'] ? 'modules': 'addons';
            //echo $dir;
            //组合控制器类名（包括命名空间路径）
            //$className = addons\student\controller\Grade
            $className = "{$dir}\\{$m}\controller\\".ucfirst($arr[1]);

            //echo $className;
            //call_user_func_array([new 类名,方法名],[]);
            echo  call_user_func_array( [new $className,$arr[2] ],[]);
            exit;
        }
    }

    function display($tpl = '', $var = [])
    {
        //组合模版路径
        //echo __TEMPLATE__."/{$tpl}";
        return view(TEMPLATE.'/'.$tpl,$var);
    }
}