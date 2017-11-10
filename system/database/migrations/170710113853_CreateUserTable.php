<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateUserTable extends Migration {
    //后台用户表user
    //username,password
	public function up() {
		Schema::create( 'user', function ( Blueprint $table ) {
			$table->increments( 'uid' );
			$table->char( 'username' ,30);
			$table->string( 'password' );
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'user' );
    }
}