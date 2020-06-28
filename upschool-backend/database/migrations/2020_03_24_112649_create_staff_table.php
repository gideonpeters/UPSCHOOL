<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('staff_number')->unique();
            $table->year('year_of_entry')->nullable();
            $table->foreignId('department_id')->nullable()->onDelete('cascade');
            $table->string('rank')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            // $table->string('address')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
