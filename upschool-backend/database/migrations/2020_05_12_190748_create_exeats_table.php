<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exeats', function (Blueprint $table) {
            $table->id();
            $table->string('exeat_id');
            $table->foreignId('exeat_type_id');
            $table->string('status')->default('pending');
            $table->longText('reason');
            $table->dateTime('requested_departure');
            $table->dateTime('actual_departure')->nullable();
            $table->dateTime('expected_arrival');
            $table->dateTime('actual_arrival')->nullable();
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
        Schema::dropIfExists('exeats');
    }
}
