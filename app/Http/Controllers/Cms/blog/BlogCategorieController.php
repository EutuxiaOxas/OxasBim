<?php

namespace App\Http\Controllers\Cms\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BlogCategorie;
use Storage;
use Str;
class BlogCategorieController extends Controller
{
    public function index()
    {
    	$categorias = BlogCategorie::all();

    	return view('cms.blog.categorias.index', compact('categorias'));
    }


    public function crearCategoria(Request $request)
    {
    	$path = $request->file('picture')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);

    	BlogCategorie::create([
    		'name' => $request->name,
    		'description' => $request->description,
    		'picture' => $file,
    	]);

    	return back()->with('message', 'Categoria creada con éxito');

    	//
    }


    public function actualizarCategoria(Request $request, $id)
    {

    	$categoria = BlogCategorie::find($id);

    	if($request->file('picture'))
    	{
    		$deleted = Storage::disk('public')->delete($categoria->picture);

    		if(isset($deleted) || $categoria->picture == null)
    		{
    			$path = $request->file('picture')->store('public');
    			$file = Str::replaceFirst('public/', '',$path);

    			$categoria->update([
    				'name' => $request->name,
    				'description' => $request->description,
    				'picture' => $file,
    			]);
    		}else {
    			return back()->with('error', 'No se pudo actualizar la categoria actualizada con éxito');
    		}

    	}else {
    		$categoria->update([
    			'name' => $request->name,
    			'description' => $request->description,
    		]);
    	}

    	return back()->with('message', 'Categoria actualizada con éxito');
    }


    public function eliminarCategoria($id)
    {
    	$categoria = BlogCategorie::find($id);

    	$deleted = Storage::disk('public')->delete($categoria->picture);

    	if(isset($deleted) || $categoria->picture == null)
    	{
    		$categoria->delete();

    		return back()->with('error', 'Categoria eliminada con éxito');
    	}

    	return back()->with('error', 'No se pudo eliminar la categoria');
    }
}
