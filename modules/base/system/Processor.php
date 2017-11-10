<?php
/**
 * Created by PhpStorm.
 * User: Adminstrator
 * Date: 2017/7/13
 * Time: 21:27
 */
namespace modules\base\system;

use modules\base\model\BaseContent;
use modules\GmProcessor;

class Processor extends GmProcessor {
    /**
     * 执行消息回复
     * @param $id  [实例化时传过来的参数id]
     */
    public function handle($id){
        //$aaa= BaseContent::where('id',$id)->pluck('content');
        //file_put_contents('aa.txt',print_r($aaa,true));
        //给用户胡回复内容，回复的内容为baseContent表中对应的id的内容
        $this->text(BaseContent::where('id',$id)->pluck('content'));
    }

}