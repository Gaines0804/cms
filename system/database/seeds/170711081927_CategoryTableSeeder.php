<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
use system\model\Category;
class CategoryTableSeeder extends Seeder {
    //执行
	public function up() {
        $data = [
            [
                'catname' => '娱乐',
                'description' =>'娱乐描述',
                'linkurl' => 'http://www.houdunwang.com'
            ],
            [
                'catname' => '体育',
                'description' =>'体育描述',
                'linkurl' => 'http://www.houdunwang.com'
            ],
            [
                'catname' => 'KTV',
                'description' =>'KTV描述',
                'pid' => 1,
                'linkurl' => 'http://www.houdunwang.com'
            ],

        ];
        foreach ($data as $d){
            (new Category)->save($d);
        }
    }
    //回滚
    public function down() {
        Schema::truncate('category');
    }
}