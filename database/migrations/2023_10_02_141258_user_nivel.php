<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserNivel extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nivel',10)->default('admin')->nullable();
            $table->string('ativo',1)->default('S')->nullable();
        });
    }


}
