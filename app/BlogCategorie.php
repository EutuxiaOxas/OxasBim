<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategorie extends Model
{
    protected $fillable = ['name', 'description', 'padre_id', 'slug'];

    public function getFatherName()
    {
    	$category_padre = BlogCategorie::find($this->padre_id);

    	return $category_padre;
    }
}
