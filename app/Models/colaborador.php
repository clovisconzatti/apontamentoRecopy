<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colaborador extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'colaborador'
        ,'setor'
    ];

    protected $primaryKey = 'id';
    protected $table = 'colaborador';
}
