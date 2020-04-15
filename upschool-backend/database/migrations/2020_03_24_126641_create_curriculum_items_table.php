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
        Schema::create('curriculum_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_unit');
            $table->foreignId('curriculum_block_id');
            // $table->foreignId('semester_type_id');
            $table->unsignedBigInteger('curriculumable_id');
            $table->string('curriculumable_type');
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
        Schema::dropIfExists('curriculum_items');
    }
}
