<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinuousAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continuous_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable(); //gen or course
            $table->unsignedInteger('total')->nullable();
            $table->string('assessable_type');
            $table->unsignedBigInteger('assessable_id');
            // $table->foreignId('continuous_assessment_id')->nullable();
            // $table->foreignId('course_id')->nullable();
            // $table->foreignId('student_course_id')->nullable();
            // $table->foreignId('semester_id')->nullable();
            // $table->unsignedInteger('total_score')->nullable();
            // $table->unsignedInteger('weighted_score')->nullable();
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
        Schema::dropIfExists('continuous_assessments');
    }
}
