<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Nosotro;

use Storage; 
use Str;

class NosotrosController extends Controller
{
    public function index()
    {
    	$secciones = Nosotro::where('tipo', 'seccion')->get();
        $banner = Nosotro::where('tipo', 'banner')->first();
    	return view('cms.nosotros.index', compact('secciones', 'banner'));
    }

    public function guardarBanner(Request $request)
    {
            

            $banner = Nosotro::where('tipo', 'banner')->first();

            if(isset($banner))
            {

                if($request->file('image'))
                {
                    $deleted = Storage::disk('public')->delete($banner->image);

                    if(isset($deleted) || $banner->image == null)
                    {

                        $path = $request->file('image')->store('public');
                        $file = Str::replaceFirst('public/', '',$path);

                        $banner->update([
                            'title' => $request->title,
                            'subtitle' => 'banner principal',
                            'description' => $request->description,
                            'tipo' => 'banner',
                            'image' => $file,
                        ]);
                    }
                }else {
                    $banner->update([
                        'title' => $request->title,
                        'subtitle' => 'banner principal',
                        'description' => $request->description,
                        'tipo' => 'banner',
                    ]);
                }

                
                return back()->with('message','Banner actualizado con éxito');


            }else {

                $path = $request->file('image')->store('public');
                $file = Str::replaceFirst('public/', '',$path);


                $banner = new Nosotro;

                $banner->create([
                    'title' => $request->title,
                    'subtitle' => 'banner principal',
                    'description' => $request->description,
                    'tipo' => 'banner',
                    'image' => $file,
                ]);

                return back()->with('message','Banner creado con éxito');
            }

            
           
    }

    public function crearNosotros()
    {
    	return view('cms.nosotros.crear_nosotros');
    }

    public function guardarNosotros(Request $request)
    {
    	$path = $request->file('image')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);


    	$seccion = new Nosotro;
    	$seccion->create([
    		'title' => $request->title,
            'subtitle' => $request->subtitle,
    		'description' => $request->description,
    		'tipo' => 'seccion',
    		'image' => $file,
    	]);

    	return back()->with('message', 'Sección creada con éxito');

    }

    public function editarNosotros($id)
    {
    	$banner = Nosotro::find($id);

    	return view('cms.nosotros.editar_nosotros', compact('banner'));
    }

    public function actualizarNosotros(Request $request, $id)
    {
    	$banner = Nosotro::find($id);

    	if($request->file('image'))
    	{
    	    $deleted = Storage::disk('public')->delete($banner->image);

    	    if(isset($deleted) || $banner->image == null)
    	    {
    	        $path = $request->file('image')->store('public');

    	        $file = Str::replaceFirst('public/', '',$path);

    	        $banner->update([
    	            'title' => $request->title,
                    'subtitle' => $request->subtitle,
    	            'description' =>$request->description,
    	            'image' => $file,
    	        ]);
    	        
    	        return back()->with('message', 'Sección actualizada con éxito');
    	    } else {
    	        return back()->with('message', 'No se pudo actualizar la sección');
    	    }
    	} else {
    	    $banner->update([
    	        'title' => $request->title,
                'subtitle' => $request->subtitle,
    	        'description' =>$request->description,
    	    ]);

    	    return back()->with('message', 'Sección actualizado con éxito');
    	}
    }


    public function eliminarSeccion($id)
    {
    	$banner = Nosotro::find($id);
    	$deleted = Storage::disk('public')->delete($banner->image);
    	
    	if(isset($deleted) || $banner->image == null)
    	{
    	    $banner->delete();
    	    return back()->with('error', 'Sección eliminada con éxito');
    	} else {
    	    return back()->with('error', 'No se pudo eliminar el Banner');
    	}
    }
}
