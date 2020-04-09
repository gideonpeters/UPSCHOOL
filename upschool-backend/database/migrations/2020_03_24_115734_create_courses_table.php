<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_code');
            $table->string('venue')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('prerequisite_id')->nullable(); //prerequisite for course
            $table->foreignId('department_id')->nullable();
            // $table->unsignedInteger('courseable_id');
            // $table->unsignedInteger('credit_units'); //should be in curriculum... not here
            // $table->foreignId('course_status_id')->nullable(); //core or nuc ... should be in curriculum
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
        Schema::dropIfExists('courses');
    }
}
