<?php
namespace modules\base\controller;
use modules\base\model\BaseContent;
use modules\GmController;

class Wechat extends GmController {
    public function lists(){
        //获得数据库中的数据，显示到页面中
        $data = BaseContent::get();
        //p($data->toArray());
        //调用display方法，，载入模板文件
        return $this->display('',compact('data'));
    }

    public function post(){
        //获得get参数，我们需要通过get参数来指定所要修改的数据
        $bid = Request::get('bid');
        //echo $bid;
        //获得数据库中的数据，如果有，那么就是修改，如果没有，那么就实例化对象（添加关键词）
        $model = BaseContent::find($bid) ?: new BaseContent();
        if (IS_POST) {
            $post = Request::post();
            //1、添加关键词回复内容到数据表base_content，因为内容和关键词保存在不同的数据表中，需要分开保存
            $model['content'] = $post['content'];
            //p($model);
            $model->save();
            //2、关键词到数据表keywords中，内容和关键词不在同一个表中，需要分开保存
            $data = [
                'content_id' => $model['id'],
                'content' => $post['keywords']
            ];
            //p($data);
            //调用saveKeywords方法执行关键词的修改和添加
            $this->saveKeywords($data);
            //p($data);
            return $this->setRedirect(url('base.wechat.lists'))->success('保存成功');
        };
        //如果是编辑，那么需要分配$bid对应的关键词，页面中就可以使用数据
        $this->setKeywords($bid);
        //通过display方法载入模版文件，分配关键词回复的内容数据，这样页面这就可以使用这些数据
        return $this->display('',compact('model'));
    }

    public function remove(){
        //获得对应内容的bid，我们需要知道删除那条数据
        $bid = Request::get('bid');
        //删除内容表中的数据
        BaseContent::find($bid)->destory();
        //删除关键词表中的数据
        $this->removeKeywords($bid);
        return $this->setRedirect(url('base.wechat.lists'))->success('删除成功');
    }
}