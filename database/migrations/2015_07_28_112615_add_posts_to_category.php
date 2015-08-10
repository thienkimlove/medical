<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsToCategory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropColumn([
				'type',
				'homepage_slide',
				'homepage_intro',
				'homepage_discovery',
				'hot',
				'reason',
				'views'
			]);
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropColumn('category_id');
		});
	}

}
