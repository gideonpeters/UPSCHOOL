<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_type_id'); //alpha or omega semester
            $table->foreignId('academic_session_id');
            $table->date('start_date');
            $table->date('end_date');
            // $table->boolean('is_course_registration_period');
            // $table->boolean('is_eds_registration_period');
            // $table->boolean('is_fees_payable_period');
            $table->timestamps();
            //title
            //files
            //c.a.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semesters');
    }
}
