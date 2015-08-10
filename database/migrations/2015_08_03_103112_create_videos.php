<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('image')->unique();
			$table->boolean('hot')->default(false);
			$table->integer('views')->default(0);
			$table->string('file_name');
			$table->integer('product_id')->unsigned();
			$table->timestamps();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('videos');
	}

}
