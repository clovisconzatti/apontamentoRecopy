<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entradamp extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'data'
        ,'id_fornecedor'
        ,'id_mp'
        ,'qnt'
        ,'vlr_unit'
        ,'vlr_total'
        ,'vlr_ipi'
        ,'vlr_frete'
        ,'vlr_outros'
        ,'nro_nf'
        ,'user_id'

    ];

    protected $primaryKey = 'id';
    protected $table = 'entradamp';
}
