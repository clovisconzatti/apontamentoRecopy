<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdos extends Migration
{

    public function up()
    {
        Schema::table('apontamento', function (Blueprint $table) {
            $table->integer('id_os')->nullable();
        });
    }


}
