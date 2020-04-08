<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('curriculum_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('level');
        //     $table->unsignedBigInteger('credit_unit');
        //     // $table->foreignId('curriculum_id');
        //     $table->foreignId('course_status_id');
        //     $table->foreignId('course_id');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_items');
    }
}
