<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObsApontamento extends Migration
{
    public function up()
    {
        Schema::table('apontamento', function (Blueprint $table) {
            $table->string('obs',255)->nullable();
        });
    }


}
