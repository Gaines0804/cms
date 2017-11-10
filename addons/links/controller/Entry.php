<?php
namespace addons\links\controller;
use addons\links\model\Links;
use modules\GmController;
class Entry extends GmController{
    public function index(){
        $data = Links::get() ? Links::orderBy('orderby','asc')->get() : new Links();
        //p($data);exit;
        //echo 'links index';
        return $this->display('index',compact('data'));
    }
    public function post(){
        $model = Links::find(Request::get('lid')) ?: new Links();
        if(IS_POST){
            $post=Request::post();
            //p($post);
            $model->save($post);
            return $this->setRedirect(url('links.entry.index'))->success('保存成功');
        }
        return $this->display('',compact('model'));
    }

    public function remove(){
        Links::find(Request::get('lid'))->destory();
        return $this->setRedirect(url('links.entry.index'))->success('删除成功');
    }
}