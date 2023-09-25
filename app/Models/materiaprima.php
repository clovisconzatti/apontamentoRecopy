<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiaprima extends Model
{

    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'materiaprima'
        ,'unidade'

    ];

    protected $primaryKey = 'id';
    protected $table = 'materiaprima';
}
