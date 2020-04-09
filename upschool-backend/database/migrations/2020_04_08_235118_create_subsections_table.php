<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // title: "Module 1",
        // 				subsection: [
        // 					{ id: 1, name: "i8086.pdf", type: "file" },
        // 					{
        // 						id: 2,
        // 						name: "Mobility of electrons.docx",
        // 						type: "file"
        // 					},
        // 					{ id: 3, name: "Term Paper", type: "assignment" }
        // 				]
        Schema::create('subsections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); //file/task
            $table->foreignId('course_section_id');
            $table->longText('body');
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
        Schema::dropIfExists('subsections');
    }
}
