<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProductos extends Model
{
    protected $table = 'pedidos_productos';

    protected $fillable = ['pedido_id', 'product_id', 'quantity', 'price'];

    public function product() 
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
