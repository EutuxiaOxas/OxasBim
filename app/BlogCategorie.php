<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategorie extends Model
{
    protected $fillable = ['name', 'picture', 'description'];
}
