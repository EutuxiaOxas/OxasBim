<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuraciones;
class ConfiguracionesController extends Controller
{
    public function index()
    {
    	$whatsapp = Configuraciones::where('title', 'whatsapp')->first();
    	$secName = 'configuraciones';

        $metodos_pago = Configuraciones::where('title', 'PAGO')->get();
        $metodos_envio = Configuraciones::where('title', 'ENVIO')->get();

    	return view('cms.configuraciones.index', compact('whatsapp', 'secName', 'metodos_pago', 'metodos_envio'));
    }


    public function agregarConfiguracion(Request $request)
    {
        Configuraciones::create($request->all());

        return back();
    }

    public function actualizarConfiguracion(Request $request)
    {   
    	$configuracion = Configuraciones::findOrFail($request->id);

        $configuracion->update($request->all());

        return back()->with('message', 'Configuracion actualizada con éxito!');
    }
}
