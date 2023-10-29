<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePubZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->text('title');
            $table->string('code');
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
        Schema::dropIfExists('pub_zones');
    }
}
