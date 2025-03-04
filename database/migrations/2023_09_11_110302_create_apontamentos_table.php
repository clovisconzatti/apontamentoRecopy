<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApontamentosTable extends Migration
{
    public function up()
    {
        Schema::create('apontamento', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->date('data')->nullable();
            $table->time('h_inicial')->nullable();
            $table->time('h_final')->nullable();
            $table->string('nro_os',15)->nullable();
            $table->integer('cliente')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apontamento');
    }
}
