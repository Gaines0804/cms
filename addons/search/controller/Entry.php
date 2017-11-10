<?php
namespace addons\search\controller;
use system\model\Article;
use houdunwang\db\Db;
class Entry{

    /**
     * 关键词列表页
     * @return mixed
     */
    public function index(){
        //获得关键词信息，显示在列表页中
        $keywords = Db::table('search_keywords')->orderby('times','desc')->get();
        return $this->display('',compact('keywords'));
    }

    public function search(){
        //p(Request::get());
        //获得关键词
        $keywords = Request::get('keywords');
        //echo $keywords;
        //搜索和关键词匹配的文章标题或者内容
        $arcModel = Article::where('title','like',"%{$keywords}%")->orwhere('content','like',"%{$keywords}%")->paginate(5);
        //p($arcModel->toArray());
        $arcData = $arcModel->toArray();
        //处理关键词
        if($arcData){
            //组合where条件
            $where = ['keywords',$keywords];
            //检测是否能够从数据库中查询到关键词
            $searchKeywords = Db::table('search_keywords')->where($where)->first();
            if($searchKeywords){
                //搜索到搜索次数加1
                Db::table('search_keywords')->where($where)->increment('times',1);
            }else if($keywords){
                //否则为新的关键词插入到数据库
                Db::table('search_keywords')->insert(['keywords'=>$keywords,'times'=>1]);
            }
        }
        //载入搜索结果现实的模版
        return view(TEMPLATE . '/search.html',compact('arcModel','arcData','keywords'));
    }
}