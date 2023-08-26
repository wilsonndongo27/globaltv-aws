<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertizingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertizings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->string('title');
            $table->longText('resume'); 
            $table->date('date_start');
            $table->date('date_end');
            $table->string('cover');
            $table->string('video');
            $table->integer('is_video')->default(0);
            $table->integer('is_active')->default(1);
            $table->integer('is_valid')->default(0);
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
        Schema::dropIfExists('advertizings');
    }
}
