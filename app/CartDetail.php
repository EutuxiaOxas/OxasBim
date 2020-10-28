<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = ['product_id', 'cart_id', 'cantidad'];

    public function cart()
    {
    	return $this->belongsTo('App\Cart', 'cart_id');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
