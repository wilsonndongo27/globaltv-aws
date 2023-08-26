<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->integer('user')->unsigned();
            $table->integer('rule')->unsigned();
            $table->string('title');
            $table->longText('description');
            $table->integer('is_active')->default(1);
            $table->foreign('author')->references('id')->on('users');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('rule')->references('id')->on('rule_menus');
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
        Schema::dropIfExists('rule_users');
    }
}
