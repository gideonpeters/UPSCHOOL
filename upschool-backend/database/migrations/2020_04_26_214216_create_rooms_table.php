<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->text('description')->nullable();
            $table->unsignedInteger('capacity')->nullable(); //number of beds
            $table->string('wing')->nullable();
            $table->json('preferred_sex')->nullable();
            $table->json('preferred_level')->nullable();
            $table->boolean('status')->nullable(); //available or not
            $table->json('preferred_student_type')->nullable();
            $table->json('preferred_nationality')->nullable();
            $table->json('preferred_program')->nullable();
            $table->foreignId('room_type_id')->onDelete('cascade');
            $table->foreignId('hall_id')->onDelete('cascade');
            // $table->foreignId('key_possessor_id')->nullable();
            // $table->foreignId('_id');
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
        Schema::dropIfExists('rooms');
    }
}
