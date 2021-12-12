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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('gender')->nullable();
            $table->tinyInteger('role')->nullable();
            $table->string('user_slug')->unique();
            $table->string('profile_photo',192)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('otp_verified')->default(0);
            $table->tinyInteger('documents_verified')->default(0);
            $table->timestamp('last_login')->nullable();
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
