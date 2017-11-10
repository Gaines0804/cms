<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateWechatConfigTable extends Migration {
    //执行
	public function up() {
		Schema::create( 'wechat_config', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->text( 'content' )->comment('微信配置信息');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'wechat_config' );
    }
}