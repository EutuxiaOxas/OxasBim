<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Publicidad;
use Storage;
use Str;

class PublicidadController extends Controller
{
    public function crearPublicidad()
    {
    	$secName = 'web';
    	return view('cms.banner.publicidades.crear_publicidad', compact('secName'));
    }

    public function guardarPublicidad(Request $request)
    {
    	$path = $request->file('image')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);

    	$publicidad = Publicidad::create([
    		'image' => $file,
    		'link' => $request->link,
    	]);

    	return back()->with('message', 'Publicidad creada con éxito');
    }

    public function editarPublicidad($id)
    {
    	$publicidad  = Publicidad::find($id);
    	$secName = 'web';
    	return view('cms.banner.publicidades.editar_publicidad', compact('secName', 'publicidad'));
    }

    public function actualizarPublicidad(Request $request, $id)
    {
    	$publicidad  = Publicidad::find($id);
    	//dd($publicidad);
    	if($request->file('image'))
    	{
    	    $deleted = Storage::disk('public')->delete($publicidad->image);

    	    if(isset($deleted) || $publicidad->image == null)
    	    {
    	        $path = $request->file('image')->store('public');

    	        $file = Str::replaceFirst('public/', '',$path);

    	        $publicidad->update([
    	            'link' => $request->link,
    	            'image' => $file,
    	        ]);

    	        return back()->with('message', 'Publicidad actualizada con éxito');
    	    } else {
    	        return back()->with('message', 'No se pudo actualizar la Publicidad');
    	    }
    	} else {
    	    $publicidad->update([
    	        'link' => $request->link,
    	    ]);

    	    return back()->with('message', 'Publicidad actualizada con éxito');
    	}
    }

    public function eliminarPublicidad($id){
        $publicidad = Publicidad::find($id);
        $deleted = Storage::disk('public')->delete($publicidad->image);

        if(isset($deleted) || $publicidad->image == null)
        {
            $publicidad->delete();
            return back()->with('error', 'Punlicidad eliminada con éxito');
        } else {
            return back()->with('error', 'No se pudo eliminar la publicidad');
        }

    }
}
