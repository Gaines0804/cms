<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Slide as SlideModel;

class Slide extends Controller{
    //动作
    public function lists(){
        $data = SlideModel::get();
        return view('',compact('data'));
    }

    public function post(){
        $sid = Request::get('sid');
        //p($sid);exit;
        $model = SlideModel::find($sid)?:new SlideModel();
        if(IS_POST){
            $post = Request::post();
            //p($post);exit;
            $model->save($post);
            return $this->setRedirect(u('lists'))->success('保存成功');
        }
        return view('',compact('model'));
    }

    public function remove(){
        SlideModel::find(Request::get('sid'))->destory();
        return $this->setRedirect(u('lists'))->success('删除成功');

    }
}
