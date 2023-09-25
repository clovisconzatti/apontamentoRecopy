<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaprimasTable extends Migration
{
    public function up()
    {
        Schema::create('materiaprima', function (Blueprint $table) {
            $table->increments('id');
            $table->string('materiaprima',30)->nullable();
            $table->string('unidade',10)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }
}
