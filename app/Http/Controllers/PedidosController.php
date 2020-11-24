<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedidos;
use App\PedidoProductos;
use App\Product;
class PedidosController extends Controller
{
    
	public function index()
	{
		$pedidos = Pedidos::orderBy('id', 'DESC')->get();
		$secName = 'tienda';
		return view('cms.pedidos.index', compact('pedidos', 'secName'));
	}

    public function crearPedido(Request $request)
    {
        foreach ($request->productos as $p) {

            $producto = Product::find($p['id']);

            if($producto->quantity > 0)
            {
                $cantidad = $producto->quantity - $p['cantidad'];

                if($cantidad === 0 || $cantidad > 0)
                {
                    $producto->quantity = $cantidad;
                    $producto->save();
                }
            }
        }

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

    	return response()->json($pedido->id, 200);
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
