<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMateriasPrimasTable extends Migration
{
    public function up()
    {
        Schema::table('materias_primas', function (Blueprint $table) {
            $table->string('materiaprima', 100)->change();
        });
    }

}
