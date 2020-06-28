<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->onDelete('cascade');
            $table->foreignId('semester_id')->onDelete('cascade');
            $table->unsignedDecimal('gpa', 8, 4)->nullable();
            $table->unsignedDecimal('cgpa', 8, 4)->nullable();
            $table->unsignedInteger('total_units')->nullable();
            $table->unsignedInteger('total_weighted_score')->nullable();
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
        Schema::dropIfExists('results');
    }
}
