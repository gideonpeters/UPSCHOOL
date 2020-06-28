<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->onDelete('cascade');
            $table->foreignId('course_status_id')->onDelete('cascade');
            $table->string('level');
            $table->unsignedInteger('max_required_units')->nullable();
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
        Schema::dropIfExists('curriculum_blocks');
    }
}
