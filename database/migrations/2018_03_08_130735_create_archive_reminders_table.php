<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->string('title', 255);
            $table->unsignedInteger('category')->default(1);
            $table->boolean('isPayment');
            $table->double('amount')->nullable();
            $table->string('location', 1000)->nullable();
            $table->string('frecuency', 256); // once, certain days, certain date, every month
            $table->date('alarmDate')->nullable();
            $table->time('alarmTime');
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
        Schema::dropIfExists('archive_reminders');
    }
}
