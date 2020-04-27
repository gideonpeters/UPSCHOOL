<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('room_id');
            $table->foreignId('is_reserved')->nullable();
            $table->boolean('has_key')->nullable();
            $table->boolean('is_signed_in')->nullable();
            $table->foreignId('semester_id')->nullable();
            $table->foreignId('session_id')->nullable();
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
        Schema::dropIfExists('student_rooms');
    }
}
