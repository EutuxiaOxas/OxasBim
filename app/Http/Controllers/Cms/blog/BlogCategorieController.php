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
            'padre_id' => $request->padre_id
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
		]);

    	return back()->with('message', 'Categoria actualizada con éxito');
    }


    public function eliminarCategoria($id)
    {
    	$categoria = BlogCategorie::find($id);

		$categoria->delete();

		return back()->with('error', 'Categoria eliminada con éxito');

    }

    //--------- OBTENER CATEGORIA POR AJAX -----------
    public function obtenerCategoria($id)
    {
        return BlogCategorie::where('padre_id', 0)->get();
    }
}
