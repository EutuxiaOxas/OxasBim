<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compradores;
use App\Configuraciones;
use App\PedidoProductos;
use App\Pedidos;
use App\Product;

class WhatsappController extends Controller
{
    public function irAWhatsapp(Request $request)
    {
        $nombre = $request->nombre;
        $email = $request->correo;
        $amount = $request->total_amount;

        $total_products = json_decode($request->total_products, TRUE);

        // creo la orden
    	$pedido = Pedidos::create([
    		'name' 			=> $nombre,
    		'total_amount' 	=> $amount,
    	]);

        $pedido_id =$pedido->id;

        $productos_array = array();

        // guardo los productos de la orden
    	foreach ($total_products as $producto) {

            $product_id = $producto['id'];
            $quantity = $producto['quantity'];

            $product = Product::find($product_id);

    		$precio = $product->price;

            $producto_string = '('.$quantity.')'.$product->title.'%20-%20'.$precio.'$';
            array_push( $productos_array, $producto_string);


    		PedidoProductos::create([
    			'pedido_id' 	=> $pedido_id,
    			'product_id' 	=> $product_id,
    			'quantity'		=> $quantity,
    			'price' 		=> $precio,
    		]);
    	}

        // el string de todos los productos, para enviar por whatsapp
        $productos_comprados = implode("%0A", $productos_array);

        // Registro al comprador
        Compradores::create([
            'pedido_id'		=> $pedido_id,
            'nombre' 	    => $nombre,
            'email' 	    => $email,
        ]);

        // Obtengo el numero de Whatsapp
        $numero = Configuraciones::where('title', 'whatsapp')->first()->description;
    	$mensaje_main = "https://api.whatsapp.com/send?phone=".$numero;
    	$mensaje_datos_comprador ="&text="."Compra por sitio web%0A%0A".$nombre."%0A%0A"."Correo: ".$email."%0A%0A-------------%0A%0A";

    	$mensaje_productos = $productos_comprados."%0A%0A-------------%0A";

    	$mensaje_total = "Total a pagar%0A%0A".number_format($amount,2)." $";

    	$mensaje_final = $mensaje_main.$mensaje_datos_comprador.$mensaje_productos.$mensaje_total;

    	return redirect($mensaje_final);
    }
}
