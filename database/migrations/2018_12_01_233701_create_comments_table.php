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
            $table->integer('id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from users
            $table->integer('groupID')->references('groupID')->on('studygroup')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from studygroup
            $table->string('content');
            $table->dateTime('timeStamp');
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
