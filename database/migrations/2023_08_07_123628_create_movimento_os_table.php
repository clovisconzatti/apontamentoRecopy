<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentoOsTable extends Migration
{
    public function up()
    {
        Schema::create('movimento_os', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movimentoos_id')->nullable();
            $table->integer('mp_is')->nullable();
            $table->integer('qnt')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }
}