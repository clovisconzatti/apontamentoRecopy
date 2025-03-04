<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Entradamp extends Migration
{
    public function up()
    {
        Schema::create('entradamp', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data')->nullable();
            $table->integer('id_fornecedor')->nullable();
            $table->integer('id_mp')->nullable();
            $table->double('qnt')->nullable();
            $table->double('vlr_unit')->nullable();
            $table->double('vlr_total')->nullable();
            $table->double('vlr_ipi')->nullable();
            $table->double('vlr_frete')->nullable();
            $table->double('vlr_outros')->nullable();
            $table->integer('nro_nf')->nullable();
            $table->integer('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }
}
