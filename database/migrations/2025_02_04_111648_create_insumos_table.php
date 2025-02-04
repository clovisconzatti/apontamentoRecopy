<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosTable extends Migration
{
    public function up()
    {
        Schema::create('insumo', function(Blueprint $table){
            $table->increments('id');
            $table->date('data')->nullable();
            $table->integer('id_materiaprima')->nullable();
            $table->integer('qtd')->nullable();
            $table->integer('os')->nullable();
            $table->string('unid_medida',10)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumo');
    }
}
