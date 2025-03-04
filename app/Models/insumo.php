<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insumo extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'data'
        ,'id_materiaprima'
        ,'qtd'
        ,'os'
        ,'unid_medida'

    ];

    protected $primaryKey = 'id';
    protected $table = 'insumo';
}
