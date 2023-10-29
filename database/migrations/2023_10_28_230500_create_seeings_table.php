<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeings', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('news')->nullable();
            $table->foreignId('replay')->nullable();
            $table->foreignId('podcast')->nullable();
            $table->foreignId('advertizing')->nullable();
            $table->longText('info_user');
            $table->integer('is_internal_user')->default(0);
            $table->integer('is_read')->default(0);
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('seeings');
    }
}
