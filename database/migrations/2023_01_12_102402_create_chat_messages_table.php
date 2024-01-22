<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('from');
            $table->foreign('from')->references('id')->on('users');

            $table->unsignedBigInteger('to');
            $table->foreign('to')->references('id')->on('users');

            $table->string('message', 2000)->nullable();
            $table->string('file', 150)->nullable();
            $table->boolean('read')->default(0);

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
        Schema::dropIfExists('chat_messages');
    }
};
