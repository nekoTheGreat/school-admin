<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('type');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::create('roles', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('access');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);
        });

        Schema::create('classrooms', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);
        });

        Schema::create('students', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('grade_level');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('teachers', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('rank');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('subjects', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('category');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);
        });

        Schema::create('classroom_teachers', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('classroom_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
        });

        Schema::create('teacher_students', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('classroom_students', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('markings', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->decimal('mark');
            $table->enum('status', ['draft', 'final']);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable(true);
            $table->string('created_by');
            $table->string('updated_by')->nullable(true);

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('students');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('classroom_teachers');
        Schema::dropIfExists('teacher_students');
        Schema::dropIfExists('classroom_students');
        Schema::dropIfExists('markings');
    }
}
