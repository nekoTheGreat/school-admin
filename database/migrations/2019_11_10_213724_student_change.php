<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('students', function(Blueprint $table){
            $table->unsignedBigInteger('classroom_id');

            $table->foreign('classroom_id', 'students_classroom_id_foreign')->references('id')->on('classrooms');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('students', function(Blueprint $table){
            $table->dropForeign('students_classroom_id_foreign');
            $table->dropColumn('classroom_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}
