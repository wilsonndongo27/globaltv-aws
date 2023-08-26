<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('phone')->unique();
            $table->foreignId('country');
            $table->foreignId('state');
            $table->foreignId('city');
            $table->string('address');
            $table->string('pp')->default('default_pp.png');
            $table->string('cover')->default('default_pp.png');
            $table->string('password');
            $table->integer('is_superadmin')->default(0);
            $table->integer('is_admin')->default(0);
            $table->integer('is_apiuser')->default(0);
            $table->integer('is_staff')->default(0);
            $table->integer('is_agent')->default(0);
            $table->integer('is_api')->default(0);
            $table->integer('is_active')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
