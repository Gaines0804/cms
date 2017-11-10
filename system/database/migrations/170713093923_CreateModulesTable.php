<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateModulesTable extends Migration {
    //执行
	public function up() {
        //			name(模块英文标识),title（模块名称）,resume(模块介绍),author(模块作者),preview(模块预览图),is_system(是否为系统模块),is_wechat(是否处理微信)
		Schema::create( 'modules', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' )->comment('模块英文标识');
			$table->string( 'title' )->comment('模块名称');
			$table->string( 'resume' )->comment('模块介绍');
			$table->string( 'author' )->comment('模块作者');
			$table->string( 'preview' )->comment('模块预览图');
			$table->tinyInteger( 'is_system' )->defaults(0)->comment('是否为系统模块');
			$table->tinyInteger( 'is_wechat' )->defaults(0)->comment('是否处理微信');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'modules' );
    }
}