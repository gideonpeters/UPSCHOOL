<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('total_score');
            $table->foreignId('course_id')->nullable()->onDelete('cascade');
            $table->unsignedInteger('percentage')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('visible')->default(false);
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
        Schema::dropIfExists('school_assessments');
    }
}
