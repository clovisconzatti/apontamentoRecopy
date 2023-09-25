<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'produto'

    ];

    protected $primaryKey = 'id';
    protected $table = 'produto';
}
