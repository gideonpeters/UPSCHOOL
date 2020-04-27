<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('allocate_after_pay')->default(true);
            $table->boolean('allocate_personal')->default(false); //default is allocated by school
            $table->boolean('allocate_school')->default(true);
            $table->boolean('allocate_by_semester')->default(true);
            $table->boolean('allocate_by_session')->default(false);
            $table->boolean('allocate_by_sex')->default(true);
            $table->boolean('allocate_by_level')->default(true);
            $table->boolean('allocate_by_program')->default(true);
            $table->boolean('allocate_by_student_type')->default(true);
            $table->boolean('allocate_by_nationality')->default(true);
            $table->boolean('allocate_reservable')->default(false);
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
        Schema::dropIfExists('allocation_settings');
    }
}
