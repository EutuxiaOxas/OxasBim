<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compradores;
class WhatsappController extends Controller
{
    public function irAWhatsapp(Request $request)
    {
    	Compradores::create($request->all());
    	
    	$mensaje_main = 'https://wa.me/send?phone=584260486086';

    	$mensaje_datos_comprador ="&text="."Compra por sitio web%0A%0A".$request->nombre."%0A%0A"."CI. ".$request->documento_identidad."%0A%0A-------------%0A%0A";

    	$mensaje_productos = $request->productos."%0A%0A-------------%0A";

    	$mensaje_total = "Total a pagar%0A%0A".$request->total." $";

    	$mensaje_final = $mensaje_main.$mensaje_datos_comprador.$mensaje_productos.$mensaje_total;
    	
    	return redirect($mensaje_final);
    }
}
