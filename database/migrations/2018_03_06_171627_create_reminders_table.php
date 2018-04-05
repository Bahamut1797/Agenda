<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->string('title', 150);
            $table->unsignedInteger('category')->default(1);
            $table->boolean('isPayment');
            $table->double('amount')->nullable();
            $table->string('location', 1000)->nullable();
            $table->string('urlLoc', 2000)->nullable();
            $table->string('contact', 15)->nullable();
            $table->string('frecuency', 256);
            $table->boolean('repeat');
            $table->date('alarmDate')->nullable();
            $table->time('alarmTime');
            $table->string('secEmail', 256)->nullable();
            $table->boolean('archiveIt');
            $table->boolean('isSecret');
            $table->timestamps();
            $table->foreign('category')->references('id')->on('categories');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
