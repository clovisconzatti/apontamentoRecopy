<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoProduto extends Migration
{
    public function up()
    {
        Schema::table('materiaprima', function (Blueprint $table) {
            $table->string('tipo',255)->nullable();
        });
    }


}
