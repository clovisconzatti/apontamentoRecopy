<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodigomateriaprima extends Migration
{

    public function up()
    {
        Schema::table('materiaprima', function (Blueprint $table) {
            $table->integer('cod_sistema')->nullable();
            $table->integer('estoque_minimo')->nullable();
        });
    }


}
