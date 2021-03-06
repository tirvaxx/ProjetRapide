<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email',50)->unique();
            $table->string('telephone', 12)->nullable();
            $table->string('photo', 30)->default('45x45.png');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });

        
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
