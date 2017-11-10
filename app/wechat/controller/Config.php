<?php namespace app\wechat\controller;


use houdunwang\view\View;
use system\model\WechatConfig;

class Config extends Common {
    //微信设置
    public function setting(){

        //获得数据库文件，判断能否查询到数据，如果能够查到数据，说明数据库中有数据，如果没有查询到数据，那么就需要实例化一个对象，我们需要在后面通过实例化来执行数据的添加和修改
        $model = WechatConfig::find(1) ?: new WechatConfig();
        //p($model);
        if(IS_POST){
            //获得表单数据，我们需要将数据保存到数据库中
            $post = Request::post();

            //我们需要将消息数据追加到微信配置项数据中
            //需要获得json对象中的content数据转换为数组，我们需要向数组中追加数据
            $content = json_decode($model['content'],true);
            //将用户输入的内容与数据库中数据进行合并，如果字段名重复，就会覆盖（而且是后面的覆盖前面的，这样就会更改原来的数据）
            //转换为json，需要在将数据存入对象中
            $content = json_encode(array_merge($content,$post),JSON_UNESCAPED_UNICODE);

            //将数据存入$model中的content字段中
            $model['content'] = $content;
            //实例化调用save方法，完成数据保存
            $model->save();
            $this->setRedirect('refresh')->success('保存成功');
        }

        //判断第一次是否有数据，如果有数据那么就将数据转换为数组形式，如果不存在，那么就先默认给定空数组，如果第一次没有数据，那么在前端页面就会报错（数据查询不到）
        //将数据转换为可操作的数组形式
        $model = $model['content'] ? json_decode($model['content'],true) : [];
        //p($model);
        //如果数据库中没有数据，那么我们可以给token、encodingaeskey有默认值，这里使用随机值
        if(empty($model)){
            //随机产生token（6-32位）
            $model['token']=md5(time());
            //随机encodingaeskey（43位）
            $model['encodingaeskey']=md5(microtime(true)).substr(md5(time()),0,11);
            //echo strlen('0e7ed8408df66a1a851652089676b6778e9bc080f16');
        }
        //载入模板
        return View::make()->with(compact('model'));
    }


    public function reply(){
        //获得微信配置数据库内容
        $model = WechatConfig::find(1) ?: new WechatConfig();
        //p($model);
        if(IS_POST) {
            //获得信息配置内容
            $post = Request::post();
            //p($post);
            //我们需要将消息数据追加到微信配置项数据中
            //需要获得json对象中的content数据转换为数组，我们需要向数组中追加数据
            $content = json_decode($model['content'],true);
            //将用户提交的信息追加配置数据数组中
            //转换为json数据，因为我们保存数据的时候需要操作json数据(防止字符编码)
            $content = json_encode(array_merge($content,$post),JSON_UNESCAPED_UNICODE);
            //p($content);
            //将数据存入$model中的content字段中
            $model['content']= $content;
            //执行保存
            $model -> save();

            return $this->setRedirect('refresh')->success('保存成功！');
        }
        //获得json对象中的content内容，转换为数组
        //如果第一次有数据，那么就显示数据，不需要每次都让用户重新输入
        $model = $model['content'] ? json_decode($model['content'],true) : [];
        return View::make()->with(compact('model'));
    }

}
