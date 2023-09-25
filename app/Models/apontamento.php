<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apontamento extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        , 'user_id'
        , 'data'
        , 'h_inicial'
        , 'h_final'
        , 'nro_os'
        , 'cliente'

    ];

    protected $primaryKey = 'id';
    protected $table = 'apontamento';
}
