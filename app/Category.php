<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'padre_id'];

    public function products()
    {
    	return $this->hasMany('App\Product', 'category_id');
    }


    public function getFatherName()
    {
    	$category_padre = Category::find($this->padre_id);
    	return $category_padre;
    }
}
