<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('admins');
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',50)->unique();
            $table->string('telephone', 12)->nullable();
            $table->string('photo', 30)->default('45x45.png');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });
       
       // DB::update("ALTER TABLE admins AUTO_INCREMENT = 1000000000;");
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
