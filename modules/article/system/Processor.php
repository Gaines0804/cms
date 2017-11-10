<?php
/**
 * Created by PhpStorm.
 * User: Adminstrator
 * Date: 2017/7/13
 * Time: 21:27
 */
namespace modules\article\system;

use system\model\Article;
use modules\GmProcessor;

class Processor extends GmProcessor {
    /**
     * 处理图文回复
     * @param $id  [实例化时传过来的参数id]
     */
    public function handle($id){
        //file_put_contents('a2.txt',print_r($id,true));
        //这里如果文章已经被删除到回收站，那么就不需要发送给用户，所以还需要添加一个条件
        $articleModel = Article::where([['isrecycle',0],['aid',$id]])->first();
        //file_put_contents('a.txt',print_r($articleModel,true));
        $data         = [
            [
                'title'       => $articleModel['title'],
                'discription' => $articleModel['description'],
                'picurl'      => __ROOT__ . '/' . $articleModel['thumb'],
                'url'         => __WEB__ . '/a_' . $id . '.html'
            ]
        ];
        $this->news( $data );
    }

}