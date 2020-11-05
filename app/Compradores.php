<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compradores extends Model
{
    protected $table = 'compradores';

    protected $fillable = ['nombre', 'telefono', 'documento_identidad'];
}
