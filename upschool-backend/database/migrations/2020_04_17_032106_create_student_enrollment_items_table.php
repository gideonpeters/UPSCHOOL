<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrollmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrollment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('curriculum_item_id');
            $table->string('status'); //failed, dropped, pending, ''passed', ongoing
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
        Schema::dropIfExists('student_enrollment_items');
    }
}
