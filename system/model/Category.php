<?php namespace system\model;
use houdunwang\arr\Arr;
use houdunwang\model\Model;
class Category extends Model{
	//数据表
	protected $table = "category";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
	];

	//自动完成
	protected $auto=[
		//['字段名','处理方法','方法类型',验证条件,验证时机]
        ['is_cover','0','string',self::NOT_EXIST_AUTO,self::MODEL_BOTH]
	];

	//自动过滤
    protected $filter=[
        //[表单字段名,过滤条件,处理时间]
    ];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=true;


	//获得数据的树状机构
    public static function getTreeData(){
        //先按照升序排序
        $data = self::orderBy('orderby','ASC')->get();
        //判是否有数据，如果有数据就通过tree方法获得树状结构数据，没有就默认给个空数组，防止报错
        $data = $data ? Arr::tree($data->toArray(), 'catname', 'cid', 'pid') : [];
        //p($data);exit;
        return $data;
    }

    public static function getNotMine($cid){
        //获得上面方法所得到的树状数据
        $data = self::getTreeData();
        //p($data);
        foreach ($data as $k=>$v){
            //判断是否为子栏目
            //isChild(操作的数组,子栏目id,父栏目id,...)，目前只用到前三个参数
            if(Arr::isChild($data,$v['cid'],$cid)){//这里$cid，相对于数组中的$v来说，是父栏目id
                //如果数组中有子栏目，那么就添加一个字段，在页面中用来阻止选择
                $data[$k]['_disabled'] = 'disabled';
            }else{
                //否则如果数组中存在有与$cid相同的cid时（即自己），也不能选择
                $data[$k]['_disabled'] = ($v['cid'] == $cid) ? 'disabled' : '';
            }
        }
        //返回数据
        //我们需要在编辑页面显示数据
        return $data;
    }


}