<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Compradores;
class CompradoresController extends Controller
{
    public function index()
    {
    	$secName = 'tienda';
    	$compradores = Compradores::paginate(25);
    	return view('cms.compradores.index', compact('compradores', 'secName'));
    }

    public function compradorDetalle(Request $request, $id)
    {
    	if($request->wantsJson()){

	    	$comprador = Compradores::find($id);

	    	$productos = $comprador->pedido->pedidoProductos;

	    	foreach ($productos as $producto) {
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
