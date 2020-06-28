<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exeats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exeat_type_id')->onDelete('cascade');
            $table->unsignedInteger('status'); //0=pending, 1=approved, 2=declined
            $table->text('reason');
            $table->boolean('isFlagged')->default(false);
            $table->dateTime('requested_departure_date');
            $table->dateTime('approved_departure_date')->nullable();
            $table->dateTime('actual_departure_date')->nullable();
            $table->dateTime('actual_arrival_date')->nullable();
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
        Schema::dropIfExists('student_exeats');
    }
}
