<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('用户id');
            $table->string('username', 100)->nullable()->comment('用户名');
            $table->string('email', 150)->nullable()->default(null)->comment('邮箱');
            $table->string('phone', 11)->nullable()->default(null)->comment('用户手机');
            $table->string('password')->comment('用户密码');
            $table->string('name')->nullable()->default(null)->comment('用户头像');
            $table->string('avatar')->nullable()->default(null)->comment('用户头像');
            $table->string('bio')->nullable()->default(null)->comment('用户简介');
            $table->boolean('sex')->nullable()->default(0)->comment('用户性别');
            $table->string('location')->nullable()->default(null)->comment('用户位置');
            $table->rememberToken()->comment('用户auth token');
            $table->softDeletes();
            $table->timestamps();

            $table->unique('username');
            $table->unique('email');
            $table->unique('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
