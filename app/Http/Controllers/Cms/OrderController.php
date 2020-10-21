<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
class OrderController extends Controller
{
    public function index()
    {
    	$orders = Order::orderBy('id', 'DESC')->paginate(10);
    	$secName = 'ordenes';

    	return view('cms.ventas.index', compact('orders', 'secName'));
    }


    public function nuevaOrden(){

    	$user = auth()->user();


        $oldOrder = Order::where('status', 'ACTIVO')
                        ->where('user_id', $user->id)
                        ->first();
    	
        if(isset($oldOrder))
        {
            $oldOrder->status = 'CANCELADO';
            $oldOrder->save();
        }

    	$cart = $user->cartVerify();
    	$total = $cart->cartAmount();



    	$order = Order::create([
    		'user_id' => $user->id,
    		'total_amount' => $total,
    		'status' => 'ACTIVO',
    	]);

    	$id = $order->id;


    	$cart->update([
    		'status' => 'PROCESS',
    	]);

    	foreach ($cart->cartDetails as $detalle) {
    		$oderProduct = OrderProduct::create([
    			'order_id' => $id,
    			'product_id' => $detalle->product->id,
    			'quantity' => $detalle->cantidad,
    			'price' => $detalle->product->price,
    		]);
    	}


    	return redirect("/shiping-data?orden=".$id);

    }

    public function getOrderDetail(Request $request, $id)
    {

    	if($request->wantsJson()){

    		$orden = Order::find($id);
    		$detalles = $orden->orderProduct;

    		$productos = [];

    		foreach ($detalles as $detalle) {

    			$producto = [
    				'img' => $detalle->product->image,
    				'title' => $detalle->product->title,
    				'cantidad' => $detalle->quantity,
    				'price' => $detalle->price,
    			];

    			$productos[] = $producto;
    		}

    		return $productos;
    	}

    	return redirect('/');
    	
    }


    public function cancelarOrden($id)
    {
        $orden = Order::find($id);
        $orden->status = 'CANCELADO';
        $orden->save();

        return redirect('/home')->with('message', 'Orden cancelada con éxito');
    }
}
