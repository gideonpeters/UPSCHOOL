<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id');
            $table->foreignId('curriculum_item_id');
            $table->string('grade_score');
            $table->unsignedInteger('weighted_score')->nullable();
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
        Schema::dropIfExists('result_items');
    }
}
