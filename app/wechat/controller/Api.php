<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Keywords;
use system\model\WechatConfig;
use houdunwang\wechat\WeChat;
use system\model\Modules;
//继承Common，这样只要我们执行这里的方法就会触发Common里面的构造方法，就能验证微信了
class Api extends Controller{
    //构造方法加载配置项
    public function __construct(){
//        p(v('config'));
        //执行验证操作
        $this->validate();
        WeChat::valid();
    }

    public function validate(){
        //获得数据库中微信配置信息，我们需要和框架中的配置项合并
        $info = WechatConfig::find(1) ? WechatConfig::find(1)->toArray() : new WechatConfig();
        //p($info);
        //获得数据库配置项内容，因为获得的是一个json对象，需要先转换为数组形式
        $dbConfig = $info['content'] ? json_decode($info['content'],true) : [];
        //p($dbConfig);
        //获得系统中的配置信息（通过c函数：c函数是用来快速获取/设置配置项而产生，设置并不会更改配置文件，只是影响当前请求的内存中的配置项。）
        $config = c('wechat');
        //p($config);
        //将系统配置项与数据库配置项数据合并，并且数据库中的配置优先级高于系统中的配置(需要将数据库配置数据放在系统配置数据之后)
        $newConfig = array_merge($config,$dbConfig);
        //p($newConfig);
        //我们需要将新的配置项追加给原来的配置项，不会修改配置项中的内容，只会修改内存中的配置信息
        c('wechat',$newConfig);
    }

    /**
     * 处理微信消息
     */
    public function handle(){
        //消息管理模块
//        $instance =WeChat::instance('message');
        $instance =WeChat::instance('message');
        //是否为关注
        if ($instance->isSubscribeEvent()){
            //向用户回复消息
            $instance->text(c('wechat.reply'));
        }

//        //判断是否是文本消息
//        if ($instance->isTextMsg())
//        {
//            //向用户回复消息
//            $instance->text(c('wechat.default'));
//        }

        //调用方法处理关键词回复
        //将用户发送过来的内容传给handleKeywords方法处理
        $this->handleKeywords($instance->Content);
        //回复默认消息
//        $this->handleKeywords( c('wechat.default')  );
        $instance->text( c('wechat.default')  );

    }


    /**
     * @param $content [用户发送给微信服务器端的数据]
     */
    public function handleKeywords($content){
        //file_put_contents('a3.txt',print_r($content,true));

        //1、需要知道属于哪一个模块里面的关检词
        $keywordsModel = Keywords::where('content',$content)->first();
        //2、找到关检测属于哪个模块，我们还需要知道模块是否需要操作微信，所以还需要获得模块信息
        $modulesModel = Modules::where('name',$keywordsModel['module'])->first();
        //3、判断是否需要操作微信，如果操作微信，那么就执行对应模块的操作微信的类文件
        //file_put_contents('a1.txt',print_r($keywordsModel,true));

        if($modulesModel['is_wechat']){

            //4、判断是否为系统模块
            $className = ($modulesModel['is_system'] ? 'modules' : 'addons') . "\\{$modulesModel['name']}\system\Processor";
                        //file_put_contents('a2.txt',print_r($className,true));
            call_user_func_array([new $className,'handle'],[$keywordsModel['content_id']]);
        }
    }
}
