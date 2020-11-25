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
    	$configuraciones = Configuraciones::all();
    	$array = $request->all();
    	array_shift($array);

    	foreach ($configuraciones as $config) {
    		
    		if($array[$config->title])
    		{
    			$config->content = $array[$config->title];
    			$config->save();
    		}
    	}

    	return back();
    }
}
