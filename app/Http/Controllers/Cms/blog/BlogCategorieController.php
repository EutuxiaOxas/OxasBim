<?php

namespace App\Http\Controllers\Cms\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BlogCategorie;
use Storage;
use Str;
class BlogCategorieController extends Controller
{
    //--------- PAGINA PRINCIPAL DE BLOG CATEGORIAS -----------
    public function index()
    {
    	$categorias = BlogCategorie::all();
        $secName = 'blog';
    	return view('cms.blog.categorias.index', compact('categorias', 'secName'));
    }


    public function crearCategoria(Request $request)
    {
    	BlogCategorie::create([
    		'name' => $request->name,
    		'description' => $request->description,
            'padre_id' => $request->padre_id,
            'slug' => $request->slug,
    	]);

    	return back()->with('message', 'Categoria creada con éxito');

    	//
    }


    public function actualizarCategoria(Request $request, $id)
    {

    	$categoria = BlogCategorie::find($id);

		$categoria->update([
			'name' => $request->name,
            'padre_id' => $request->padre_id,
			'description' => $request->description,
            'slug' => $request->slug,
		]);

    	return back()->with('message', 'Categoria actualizada con éxito');
    }


    public function eliminarCategoria($id)
    {
    	$categoria = BlogCategorie::find($id);

		$categoria->delete();

		return back()->with('error', 'Categoria eliminada con éxito');

    }

    //--------- OBTENER CATEGORIAS POR AJAX -----------
    public function obtenerCategoria($id)
    {
        $categoria = BlogCategorie::find($id);

        $datos = [
            'categorias' =>BlogCategorie::where('padre_id', 0)->get(),
            'slug' => $categoria->slug
        ];

        return $datos;
    }

    public function verificarSlugCategoria(Request $request)
    {
        $verificador = BlogCategorie::where('slug', $request->slug)->first();
        
        if(isset($request->id)){
            if(isset($verificador) && $verificador->id == $request->id){
                return response()->json('pertence el slug', 200);
            }
        }

        if(isset($verificador))
        {
            return response()->json('', 204);
        }else {
            return response()->json('', 200);
        }   
    }
}
