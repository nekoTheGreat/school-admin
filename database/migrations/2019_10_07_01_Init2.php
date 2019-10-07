<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
		public function up()
		{
			Schema::table('subjects', function(Blueprint $table){
				$table->string('grade_level')->nullable(true);
			});
		}

		public function down()
		{
			Schema::table('subjects', function(Blueprint $table){
				$table->dropColumn('grade_level');
			});
		}
}