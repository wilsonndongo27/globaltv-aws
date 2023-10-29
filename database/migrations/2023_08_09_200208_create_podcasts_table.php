<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->foreignId('advertizing')->nullable();
            $table->foreignId('program');
            $table->string('title');
            $table->string('label')->nullable();
            $table->longText('description'); 
            $table->string('cover');
            $table->string('audio')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_valid')->default(0);
            $table->integer('is_sponsoring')->default(0);
            $table->integer('valid_by')->unsigned()->nullable();
            $table->foreign('valid_by')->references('id')->on('users');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade')->change();
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
        Schema::dropIfExists('podcasts');
    }
}
