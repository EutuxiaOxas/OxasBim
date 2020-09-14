<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nosotro extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'image', 'tipo'];
}
