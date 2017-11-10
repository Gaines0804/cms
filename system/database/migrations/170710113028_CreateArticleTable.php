<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateArticleTable extends Migration {
    //文章表article
    //title,click,description,content,source,author,orderby,linkurl,keywords,
    //iscommend(是否推荐),ishot(是否热门,thumb,category_cid(和栏目表的关联字段)
	public function up() {
		Schema::create( 'article', function ( Blueprint $table ) {
			$table->increments( 'aid' );
			$table->string( 'title' )->comment('文章标题');
			$table->integer( 'click' )->comment('点击次数');
			$table->text( 'description' )->comment('文章描述');
			$table->text( 'content' )->comment('文章内容');
			$table->string( 'source' )->comment('文章来源');
			$table->char( 'author' )->comment('文章作者');
			$table->integer( 'orderby' )->comment('文章排序');
			$table->string( 'linkurl' )->comment('文章链接');
			$table->char( 'keywords' )->comment('文章关键词');
			$table->char( 'iscommend' )->comment('文章是否推荐');
			$table->char( 'ishot' ,20)->comment('文章是否热门');
			$table->string( 'thumb' )->comment('缩略图');
			$table->smallint( 'category_cid' )->comment('和栏目表的关联字段');
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'article' );
    }
}