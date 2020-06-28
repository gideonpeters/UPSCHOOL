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
            $table->foreignId('student_id')->onDelete('cascade');
            $table->foreignId('room_id')->onDelete('cascade');
            $table->unsignedInteger('capacity')->nullable();
            $table->foreignId('is_reserved')->nullable()->onDelete('cascade');
            $table->boolean('has_key')->nullable();
            $table->boolean('is_signed_in')->nullable();
            $table->boolean('is_signed_out')->nullable();
            $table->foreignId('semester_id')->nullable()->onDelete('cascade');
            $table->foreignId('session_id')->nullable()->onDelete('cascade');
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
