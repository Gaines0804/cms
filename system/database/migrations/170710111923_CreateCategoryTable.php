<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateCategoryTable extends Migration {
    //执行
	public function up() {
        //栏目表category
        //catname,pid,description,linkurl,orderby,thumb
		Schema::create( 'category', function ( Blueprint $table ) {
			$table->increments( 'cid' );
			$table->string( 'catname' ,30)->comment('栏目名称');
			$table->smallint( 'pid' )->comment('父级ID');
			$table->string( 'description' )->comment('栏目描述');
			$table->string( 'linkurl' )->comment('栏目链接');
			$table->integer( 'orderby' )->comment('栏目排序');
			$table->integer( 'thumb' )->comment('缩略图');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'category' );
    }
}