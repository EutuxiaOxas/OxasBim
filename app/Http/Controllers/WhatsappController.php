<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compradores;
use App\Configuraciones;
class WhatsappController extends Controller
{
    public function irAWhatsapp(Request $request)
    {
    	Compradores::create($request->all());
        $numero = Configuraciones::where('title', 'whatsapp')->first()->description;
    	$mensaje_main = "https://api.whatsapp.com/send?phone=".$numero;
    	$mensaje_datos_comprador ="&text="."Compra por sitio web%0A%0A".$request->nombre."%0A%0A"."Correo: ".$request->correo."%0A%0A-------------%0A%0A";

    	$mensaje_productos = $request->productos."%0A%0A-------------%0A";

    	$mensaje_total = "Total a pagar%0A%0A".number_format($request->total,2)." $";

    	$mensaje_final = $mensaje_main.$mensaje_datos_comprador.$mensaje_productos.$mensaje_total;

    	return redirect($mensaje_final);
    }
}
