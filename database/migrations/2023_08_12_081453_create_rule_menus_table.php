<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->integer('menu')->unsigned();
            $table->integer('submenu')->unsigned();
            $table->string('title');
            $table->longText('description');
            $table->integer('is_active')->default(1);
            $table->foreign('author')->references('id')->on('users');
            $table->foreign('menu')->references('id')->on('menus');
            $table->foreign('submenu')->references('id')->on('sub_menus');
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
        Schema::dropIfExists('rule_menus');
    }
}
