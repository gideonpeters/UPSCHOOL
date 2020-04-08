<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->foreignId('department_id')->nullable();
            // $table->foreignId('school_id')->nullable();
            $table->integer('no_of_years')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('degree_id');
            $table->unsignedInteger('max_number_of_failed_units')->nullable();
            $table->unsignedInteger('min_graduation_units')->nullable();
            $table->unsignedDecimal('min_cgpa')->nullable();
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
        Schema::dropIfExists('programs');
    }
}
