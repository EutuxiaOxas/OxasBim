<?php

namespace App\Http\Controllers\Cms\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BlogArticle;
use App\BlogCategorie;
use Storage;
use Str;
class ArticleController extends Controller
{
    public function index()
    {
    	$articulos = BlogArticle::all();
    	return view('cms.blog.articulos.index', compact('articulos'));
    }

    public function crearArticulo()
    {
    	$categorias = BlogCategorie::all();
    	return view('cms.blog.articulos.crear_articulo', compact('categorias'));
    }

    public function guardarArticulo(Request $request)
    {
    	$path = $request->file('picture')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);

    	BlogArticle::create([
    		'title' => $request->title,
            'slug' => $request->slug,
    		'content' => $request->content,
    		'category_id' => $request->category_id,
    		'autor_id' => auth()->user()->id,
    		'date' => $request->date,
    		'keywords' => 'vacio',
    		'picture' => $file,
    	]);


    	return back()->with('message', 'Articulo creado con éxito');
    }

    public function editarArticulo($id)
    {
    	$articulo = BlogArticle::find($id);
    	$categorias = BlogCategorie::all();
    	return view('cms.blog.articulos.editar_articulo', compact('articulo', 'categorias'));
    }

    public function actualizarArticulo(Request $request, $id)
    {
    	$articulo = BlogArticle::find($id);

    	if($request->file('picture'))
    	{
    		$deleted = Storage::disk('public')->delete($articulo->picture);

    		if(isset($deleted) || $articulo->picture == null)
    		{
    			$path = $request->file('picture')->store('public');
    			$file = Str::replaceFirst('public/', '',$path);

    			$articulo->update([
    				'title' => $request->title,
                    'slug' => $request->slug,
    				'content' => $request->content,
    				'category_id' => $request->category_id,
    				'date' => $request->date,
    				'keywords' => 'vacio',
    				'picture' => $file,
    			]);
    		}else {
    			return back()->with('error', 'No se pudo actualizar el articulo');
    		}

    	}else {
    		$articulo->update([
    			'title' => $request->title,
                'slug' => $request->slug,
    			'content' => $request->content,
    			'category_id' => $request->category_id,
    			'date' => $request->date,
    			'keywords' => 'vacio',
    		]);
    	}

    	return back()->with('message', 'Articulo actualizado con éxito');
    }


    public function eliminarArticulo($id)
    {
    	$articulo = BlogArticle::find($id);

    	$deleted = Storage::disk('public')->delete($articulo->picture);

    	if(isset($deleted) || $articulo->picture == null)
    	{
    		$articulo->delete();

    		return back()->with('error', 'Articulo eliminado con éxito');
    	}else {
    		return back()->with('error', 'No se puo eliminar el articulo con éxito');
    	}
    }
}
