<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Logo_Banner;

use Storage; 
use Str;


class LogoBannerController extends Controller
{
    public function index()
    {
    	$banners = Logo_Banner::where('tipo', 'banner')->get();
    	$logo = Logo_Banner::where('tipo', 'logo')->first();
        $secName = 'web';
    	return view('cms.banner.index')->with(compact('banners', 'logo', 'secName'));
    }


    /* -------------- LOGO ----------*/
    public function guardarLogo(Request $request)
    {

        $logo = Logo_Banner::where('tipo', 'logo')->first();
        if(isset($logo))
        {

            $deleted = Storage::disk('public')->delete($logo->image);

            if(isset($deleted) || $logo->image == null)
            {
                $path = $request->file('image')->store('public');

                $file = Str::replaceFirst('public/', '',$path);

                $logo->update([
                    'image' => $file,
                ]);

                return back()->with('message', 'Logo creado con éxito');
            }
                
        } else {
            $path = $request->file('image')->store('public');
            $file = Str::replaceFirst('public/', '',$path);
            
            $banner = new Logo_Banner;

            $banner->create([
                'title' => 'logo',
                'description' => 'logo el navbar',
                'status' => 1,
                'tipo' => 'logo',
                'image' => $file,
            ]);

            return back()->with('message', 'Logo actualizado con éxito');
        }
    }


    /*----------------- BANNERS  ------------*/

    public function activarBanner($id)
    {
        $banner = Logo_Banner::find($id);

        $banner->status = 1;
        $banner->save();

        return back()->with('message', 'Banner activado con éxito');

    }

    public function ocultarBanner($id)
    {
        $banner = Logo_Banner::find($id);

        $banner->status = 0;
        $banner->save();

        return back()->with('error', 'Banner ocultado con éxito');
    }

    public function crearBanner()
    {
        $secName = 'web';
    	return view('cms.banner.crear_banner', compact('secName'));
    }


    public function guardarBanner(Request $request)
    {
    	$path = $request->file('image')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);

    	$banner = new Logo_Banner;

    	$banner->create([
            'title' => $request->title,
            'description' =>$request->description,
            'status' => $request->status,
            'tipo' => $request->tipo,
            'image' => $file,
        ]);

    	return back()->with('message', 'Banner creado con éxito!');
    }


    public function editarBanner($id)
    {
        $banner = Logo_Banner::find($id);
        $secName = 'web';
        return view('cms.banner.editar_banner', compact('banner', 'secName'));
    }

    public function actualizarBanner(Request $request, $id)
    {
        $banner = Logo_Banner::find($id);

        if($request->file('image'))
        {
            $deleted = Storage::disk('public')->delete($banner->image);

            if(isset($deleted) || $banner->image == null)
            {
                $path = $request->file('image')->store('public');

                $file = Str::replaceFirst('public/', '',$path);

                $banner->update([
                    'title' => $request->title,
                    'description' =>$request->description,
                    'image' => $file,
                ]);
                
                return back()->with('message', 'Banner actualizado con éxito');
            } else {
                return back()->with('message', 'No se pudo actualizar el banner');
            }
        } else {
            $banner->update([
                'title' => $request->title,
                'description' =>$request->description,
            ]);

            return back()->with('message', 'Banner actualizado con éxito');
        }
    }

    public function eliminarBanner($id)
    {
        $banner = Logo_Banner::find($id);
        $deleted = Storage::disk('public')->delete($banner->image);
        
        if(isset($deleted) || $banner->image == null)
        {
            $banner->delete();
            return back()->with('error', 'Banner eliminado con éxito');
        } else {
            return back()->with('error', 'No se pudo eliminar el Banner');
        }
    }
}
