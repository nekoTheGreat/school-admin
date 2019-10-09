<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EducStages extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EducationStages', function(Blueprint $table){
			$table->bigIncrements('id');
      $table->string('stage');
      $table->string('level');
      $table->string('created_at');
      $table->string('created_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('EducationStages');
	}
}
