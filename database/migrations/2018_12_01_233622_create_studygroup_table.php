<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudygroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studygroup', function (Blueprint $table) {
            $table->increments('groupID');
            $table->unsignedBigInteger('courseID');
            $table->string('name');
            $table->string('description')->nullable();
            $table->time('meetTime');
            $table->string('meetDay');
            $table->string('meetLocation');
            $table->foreign('courseID')->references('courseID')->on('courses')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from Courses
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studygroup');
    }
}
