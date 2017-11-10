<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Category as categoryModel;


class Category extends Common{
    //栏目列表
    public function lists(){
        //获得数据表中的数据
        //我们需要在页面中显示数据，
        $data = categoryModel::getTreeData();
        //p($data);

        //载入模板
        return View::make()->with(compact('data'));
    }


    /**
     * 栏目编辑和保存
     */
    public function post(){
        //获得get参数，只有编辑的时候有get参数，
        //我们可以通过get参数来判断是编辑还是添加
        $cid = Request::get('cid');
        //echo $cid;
        //如果能查找到对应的数据，即是编辑操作，获得的就是一个对象
        //如果不能查找到内容，那么实例化对象，因为之后我们需要通过对象调用save等方法
        $model = categoryModel::find($cid) ?: new categoryModel();
        //p($model);
        if(IS_POST){
            //p(Request::post());
            //save既能添加又能编辑
            //这里通过Request::post将用户提交的数据进行添加/编辑
            $model->save(Request::post());
            //p($model);exit;
            return $this->setRedirect(u('lists'))->success('操作成功');
        }
        //处理子栏目、父栏目
        //选择时候不能选择自己和自己的子栏目
        $catData = categoryModel::getNotMine($cid);
        //$catData = categoryModel::get()->toArray();
        //p($catData);
        return View::make()->with(compact('model','catData'));
    }

    /**
     * 删除栏目
     */
    public function remove(){
        //获得cid
        //我们需要删除cid对应的数据
        $cid = Request::get('cid');
        //echo $cid;
        //判断是否有子栏目，如果有栏目的父级id（即pid）等于当前的cid，说明该栏目下面有子栏目
        //如果能查找到对应有pid等于当前cid的数据，说明该栏目下面有子集栏目
        if(categoryModel::where("pid",$cid)->first()){
            return $this->setRedirect('lists')->success('请先删除该栏目下面的子栏目');
        }
        if(\system\model\Article::where('category_cid',$cid)->first()){
            return $this->setRedirect('lists')->success('请先删除该栏目下面的文章');
        }
        //查找到cid对应的数据，然后删除
        categoryModel::find($cid)->destory();
        return $this->setRedirect('lists')->success('删除成功');
    }


    /**
     * 获得多维数组
     */
    public function getdata(){
        $data = categoryModel::get()->toArray();
        $data = $data ? Arr::channelLevel($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid') : [];
        p($data);
        return view('',compact('data'));
    }
}
