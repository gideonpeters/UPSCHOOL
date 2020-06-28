<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduation_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->onDelete('cascade');
            $table->foreignId('course_status_id')->onDelete('cascade');
            $table->unsignedInteger('units');
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
        Schema::dropIfExists('graduation_units');
    }
}
