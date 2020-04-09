<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // $table->string('image')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('venue')->nullable();
            $table->string('recurrence')->nullable(); //daily/weekly/none/monthly
            $table->foreignId('event_id')->nullable(); //daily/weekly/none/monthly

            $table->foreignId('semester_id');

            $table->boolean('status')->default(false)->nullable();
            $table->boolean('priority')->default(false)->nullable();

            // $table->date('date');

            $table->unsignedBigInteger('eventable_id');
            $table->string('eventable_type');

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
        Schema::dropIfExists('events');
    }
}
