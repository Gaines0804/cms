<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateKeyWordsTable extends Migration {
    //执行
	public function up() {
		Schema::create( 'keywords', function ( Blueprint $table ) {
			$table->increments( 'kid' );
			$table->string( 'module' )->comment('所属模块');
			$table->string( 'content' )->comment('关键词内容');
			$table->tinyInteger( 'content_id' )->comment('对应要回复内容的id');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'keywords' );
    }
}