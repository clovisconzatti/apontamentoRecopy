<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastroOs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_os', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario')->nullable();
            $table->date('data')->nullable();
            $table->string('cliente_id',50)->nullable();
            $table->integer('produto_id')->nullable();
            $table->integer('os')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('cadastro_os');
    }
}
