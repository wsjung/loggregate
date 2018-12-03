<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribed', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('courseID');
            $table->foreign('id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from users
            $table->foreign('courseID')->references('courseID')->on('courses')->onUpdate('cascade')->onDelete('cascade'); #Foreign Key from courses
            $table->primary(['id','courseID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribed');
    }
}
