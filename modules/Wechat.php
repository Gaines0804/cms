<?php
/**
 * Created by PhpStorm.
 * User: Adminstrator
 * Date: 2017/7/17
 * Time: 20:21
 */

namespace modules;
use system\model\Keywords;
//构建一个公共类
//因为我们保存关键词可能很多场景需要使用到
trait Wechat
{
    /**
     * 保存或者添加关键词
     * @param $data
     * @return bool
     */
    public function saveKeywords($data){
        //如果内容为空。就是关键词内容没有填写
        if(!isset($data['content']) || empty($data['content'])){
            //返回false
            return false;
        }

        //保存关键词的时候，我们还需要保存所属模块module，而module恰好为get参数里的m
        //如果已经存在module，那么就不要修改
        $m = isset($data['module']) ? $data['module']:Request::get('m');
        //将module字段保存为对应的模块
        $data['module']=$m;

        //修改和添加，这里如果是修改，那么需要通过两个字段来保证唯一性，因为不同模块的id可以相同
        $where = [
            ['module',$m],
            ['content_id',$data['content_id']]
        ];
        //如果查询不到数据就实例化类，我们需要通过实例化调用save方法完成编辑和添加
        $model = Keywords::where($where)->first() ?: new Keywords();
        $model -> save($data);
    }

    /**
     * 设置关键词
     * @param $bid [关键词对应内容的bid]
     */
    public function setKeywords($bid){
        //我们同样需要获得bid对应的数据，需要通过两个字段（module、content_id）来保证唯一性，
        $where = [
            ['module',Request::get('m')],
            ['content_id',$bid]
        ];
        $data = Keywords::where($where)->first();
        //p($data);exit;
        //分配数据，我们需要在编辑页面中显示关键词
        View::with('keywords',$data);
    }

    public function removeKeywords($bid,$m=''){
        //我们同样需要获得bid对应的数据，需要通过两个字段（module、content_id）来保证唯一性，
        $where = [
            //删除关键词的时候需要通过$bid和get参数中的m（也就是所属模块）来保证唯一性，因为baseContent表中不同的模块会出现相同的bid，比如article会有bid=1，base中也有bid=1，所以还要模块名参与查询
            //查询的时候不一定会有get参数，所以我们还需要传参
            ['module',$m ?: Request::get('m')],
            ['content_id',$bid]
        ];
        //删除对应bid的数据
        Keywords::where($where)->delete();
    }












}