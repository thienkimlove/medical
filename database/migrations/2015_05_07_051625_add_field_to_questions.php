<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToQuestions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('questions', function(Blueprint $table)
		{
			$table->string('ask_address')->nullable();
			$table->string('ask_phone')->nullable();
			$table->string('ask_email')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('questions', function(Blueprint $table)
		{
			$table->dropColumn(['ask_address', 'ask_phone', 'ask_email']);
		});
	}

}
