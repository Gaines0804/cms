<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateSlideTable extends Migration {
    //幻灯片表
    //title,url,displayorder,thumb

    public function up() {
		Schema::create( 'slide', function ( Blueprint $table ) {
			$table->increments( 'sid' );
			$table->char( 'title' )->comment('标题');
			$table->char( 'url' )->comment('链接地址');
			$table->smallint( 'displayorder' )->comment('排序');
			$table->string( 'thumb' )->comment('缩略图');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'slide' );
    }
}