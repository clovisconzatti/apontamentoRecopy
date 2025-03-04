<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradorsTable extends Migration

{
    public function up()
    {
        Schema::create('colaborador', function(Blueprint $table){
            $table->increments('id');
            $table->string('colaborador',35)->nullable();
            $table->string('setor',25)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colaborador');
    }
}
