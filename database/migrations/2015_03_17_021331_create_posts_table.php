<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('type');
            $table->string('title');
            $table->string('slug', 32)->unique();
            $table->text('desc');
            $table->text('content');
            $table->string('image');
            $table->boolean('homepage_slide')->default(false);
            $table->boolean('homepage_intro')->default(false);
            $table->boolean('homepage_discovery')->default(false);
            $table->boolean('hot')->default(false);
            $table->boolean('reason')->default(false);
            $table->integer('views')->default(0);
            $table->boolean('status')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
