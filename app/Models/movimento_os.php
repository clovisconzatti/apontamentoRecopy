<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimento_os extends Model
{

    public $timestamps = false;
    protected $fillable= [
        'id'
        ,'movimentoos_id'
        ,'mp_id'
        ,'qnt'

    ];

    protected $primaryKey = 'id';
    protected $table = 'movimento_os';
}
