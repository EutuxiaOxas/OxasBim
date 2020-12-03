<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuraciones;
class ConfiguracionesController extends Controller
{
    public function index()
    {
    	$configuraciones = Configuraciones::all();
    	$secName = 'configuraciones';
    	return view('cms.configuraciones.index', compact('configuraciones', 'secName'));
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
