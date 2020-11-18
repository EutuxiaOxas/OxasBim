<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedidos;
use App\PedidoProductos;

class PedidosController extends Controller
{
    
	public function index()
	{
		$pedidos = Pedidos::all();
		$secName = 'tienda';
		return view('cms.pedidos.index', compact('pedidos', 'secName'));
	}

    public function crearPedido(Request $request)
    {


    	$pedido = Pedidos::create([
    		'name' 			=> $request->name,
    		'total_amount' 	=> $request->total_amount,
    	]);


    	$contador = 0;
    	foreach ($request->productos as $producto) {
    		$precio = explode('$',$producto['price']);
    		
    		PedidoProductos::create([
    			'pedido_id' 	=> $pedido->id,
    			'product_id' 	=> $producto['id'],
    			'quantity'		=> $producto['cantidad'],
    			'price' 		=> $precio[1],
    		]);
    	}

    	return response()->json('', 200);
    }


    public function obtenerDetalle(Request $request, $id)
    {
    	if($request->wantsJson()){
    		$pedido = Pedidos::findOrFail($id);

    		$data = [];

    		foreach ($pedido->pedidoProductos as $producto) {
    			$data[] = [
    				'id'		=> $producto->id,
    				'image' 	=> $producto->product->image,
    				'nombre' 	=> $producto->product->title,
    				'cantidad' 	=> $producto->quantity,
    				'precio' 	=> $producto->price,
    			];
    		}

    		return response()->json($data, 200);
    	}


    	return back();
    }
}
