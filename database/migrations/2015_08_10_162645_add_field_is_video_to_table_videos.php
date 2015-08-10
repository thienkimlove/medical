<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldIsVideoToTableVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videos', function(Blueprint $table)
		{
			$table->boolean('is_video')->default(true);
			$table->dropColumn(['hot', 'views', 'file_name']);
			$table->string('url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('videos', function(Blueprint $table)
		{
			$table->dropColumn(['is_video', 'url']);
			$table->boolean('hot');
			$table->integer('views');
			$table->string('file_name');
		});
	}

}
