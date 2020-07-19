<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('matric_number')->unique();
            $table->string('reg_number')->unique();
            $table->string('level')->nullable();
            $table->year('year_of_entry')->nullable();
            $table->foreignId('promotion_status_id')->nullable()->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->onDelete('cascade');
            $table->foreignId('adviser_id')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}
