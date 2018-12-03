<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('groupID');
            $table->string('content');
            $table->dateTime('timeStamp');
            $table->foreign('id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from users
            $table->foreign('groupID')->references('groupID')->on('studygroup')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from studygroup
            $table->primary('timeStamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
