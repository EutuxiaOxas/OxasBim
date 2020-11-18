<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $fillable = ['name', 'total_amount'];


    public function pedidoProductos() 
    {
    	return $this->hasMany('App\PedidoProductos', 'pedido_id');
    }
}
