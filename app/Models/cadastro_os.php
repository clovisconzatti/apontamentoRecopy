<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cadastro_os extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'usuario'
        ,'data'
        ,'cliente_id'
        ,'produto_id'
        ,'os'

    ];

    protected $primaryKey = 'id';
    protected $table = 'cadastro_os';
}
