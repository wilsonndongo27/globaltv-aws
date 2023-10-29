<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertizingPubZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertizing_pub_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->foreignId('advertizing');
            $table->foreignId('zone');
            $table->integer('is_valid')->default(0);
            $table->integer('valid_by')->unsigned()->nullable();
            $table->foreign('valid_by')->references('id')->on('users');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('advertizing_pub_zones');
    }
}
