<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $fillable = ['title', 'content', 'descirption'];
}
