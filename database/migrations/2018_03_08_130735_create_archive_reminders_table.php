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
            $table->string('email', 256);
            $table->string('title', 255);
            $table->unsignedInteger('category')->default(1);
            $table->string('description', 1000)->nullable();
            $table->boolean('isPayment');
            $table->double('amount')->nullable();
            $table->string('location', 1000)->nullable();
            $table->string('urlLoc', 2000)->nullable();
            $table->string('contact', 15)->nullable();
            $table->enum('frecuency', ['Once', 'Daily', 'Weekly', 'Montly', 'Custom']);
            $table->string('custom', 256)->nullable();
            $table->date('alarmDate')->nullable();
            $table->time('alarmTime');
            $table->string('secEmail', 256)->nullable();
            $table->timestamps();
            $table->foreign('category')->references('id')->on('categories');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
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
