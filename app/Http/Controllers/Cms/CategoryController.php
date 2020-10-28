<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    //--------- PAGINA PRINCIPAL TIENDA/CATEGORIAS ------- 
    public function index()
    {
    	$categorias = Category::all();
        $secName = 'tienda';
    	return view('cms.productos.category', compact('categorias', 'secName'));
    }

    //--------- VERIFICACIÓN SLUG DE TIENDA CATEGORIA A TAVÉS DE AJAX -------
    public function verifySlug($slug)
    {
        $slug = Category::where('slug', $slug)->first();
        if(isset($slug))
        {
            return 'ocupado';
        }else
        {
            return 'aceptado';
        }
    }
    //--------- OBTENER CATEGORIA A TRAVÉS DE AJAX -------
    public function getCategory($id)
    {
        $category = Category::find($id);
        $data = [
            'slug' => $category->slug,
            'categorias' => Category::where('padre_id', 0)->get(),
        ];
        return $data;
    }
    //--------- GUARDAR -------
    public function guardarCategoria(Request $request)
    {
    	Category::create($request->all());

    	return back()->with('message', 'Categoría creada con éxito');
    }
    //--------- ACTUALIZAR -------
    public function atualizarCategoria(Request $request, $id)
    {
    	$categoria = Category::find($id);

    	$categoria->update($request->all());

    	return back()->with('message', 'Categoria actualizada con éxito');
    }
    //--------- ELIMINAR -------
    public function eliminarCategoria($id)
    {
    	$categoria = Category::find($id);

    	$categoria->delete();

    	return back()->with('error', 'Categoria Eliminada con éxito');
    }
}
