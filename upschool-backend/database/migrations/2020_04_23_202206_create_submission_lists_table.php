<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subsection_id');
            $table->foreignId('course_id');
            $table->dateTime('due_date')->nullable();
            $table->unsignedInteger('total_score');
            $table->foreignId('gradelist_id')->nullable();

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
        Schema::dropIfExists('submission_lists');
    }
}
