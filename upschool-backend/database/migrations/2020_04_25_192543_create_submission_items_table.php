<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_list_id');
            $table->foreignId('student_course_id');
            $table->foreignId('grade_item_id')->nullable();
            $table->longText('body')->nullable();
            $table->longText('review')->nullable();
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
        Schema::dropIfExists('submission_items');
    }
}
