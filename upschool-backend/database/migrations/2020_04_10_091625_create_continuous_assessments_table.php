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
            $table->string('name');
            $table->foreignId('continuous_assessment_id')->nullable();
            $table->foreignId('course_id');
            $table->foreignId('student_id')->nullable();
            $table->unsignedInteger('weighted_score')->nullable();
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
