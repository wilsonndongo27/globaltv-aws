<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->foreignId('program');
            $table->foreignId('category');
            $table->foreignId('country');
            $table->string('title');
            $table->string('label')->nullable(); 
            $table->longText('description');
            $table->string('cover');
            $table->string('video')->nullable();
            $table->integer('is_video')->default(1);
            $table->integer('is_active')->default(1);
            $table->integer('is_valid')->default(0);
            $table->integer('priority')->default(5);
            $table->integer('valid_by')->unsigned()->nullable();
            $table->foreign('valid_by')->references('id')->on('users');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('interviews');
    }
}
