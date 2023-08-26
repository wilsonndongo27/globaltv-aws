<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) { 
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->string('title');
            $table->longText('description');
            $table->string('cover');
            $table->time('time_start');
            $table->time('time_end');
            $table->date('date');
            $table->longText('day');
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
        Schema::dropIfExists('programs');
    }
}
