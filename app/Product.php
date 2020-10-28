<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image', 'category_id', 'slug'];


    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function images()
    {
    	return $this->hasMany('App\ProductImage', 'product_id');
    }
}
