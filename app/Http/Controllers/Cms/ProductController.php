<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductImage;

use Storage;
use Str;


class ProductController extends Controller
{
    //--------- PAGINA PRINCIPAL TIENDA/PRODUCTOS -------
    public function index()
    {
    	$productos = Product::all();
        $secName = 'tienda';
    	return view('cms.productos.productos', compact('productos', 'secName'));
    }
    //--------- VERIFICACIÓN SLUG PRODUCTO -------
    public function verifySlug(Request $request, $slug)
    {

        $slug = Product::where('slug', $slug)->first();
        $producto = Product::find($request->product_id);

        if(isset($slug) && $slug->id == $producto->id){
            return 'aceptado';
        }

        if(isset($slug))
        {
            return 'ocupado';
        }else
        {
            return 'aceptado';
        }
    }

    public function crearProducto()
    {
    	$categorias = Category::all();
        $secName = 'tienda';
    	return view('cms.productos.crear_producto', compact('categorias', 'secName'));
    }
    //--------- GUARDAR PRODUCTO -------
    public function guardarProducto(Request $request)
    {

    	$path = $request->file('image')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);

		$producto = new Product;

		$guardado = $producto->create([
	        'title' => $request->title,
	        'description' =>$request->description,
	        'price' => $request->price,
	        'category_id' => $request->category_id,
            'slug' => $request->slug,
	        'image' => $file,
	    ]);
        

        //--------- GUARDAR IMAGENES SECUNDARIOS EN CASO DE EXISTIR -------
        if($request->file('second_image'))
        {
            foreach ($request->file('second_image') as $file) {
                $path_s = $file->store('public');
                $file_s = Str::replaceFirst('public/', '',$path_s);

                ProductImage::create([
                    'product_id' => $guardado->id,
                    'image' => $file_s,
                ]);
            }
        }

        
	    return back()->with('message', 'Producto creado con éxito');
    }

    public function editarProducto($id)
    {
    	$product = Product::find($id);
    	$categorias = Category::all();
        $secName = 'tienda';
    	return view('cms.productos.editar_producto', compact('product', 'categorias', 'secName'));
    }


    public function actualizarProducto(Request $request, $id)
    {


    	$product = Product::find($id);

        //--------- ACTUALIZAR DATOS Y IMAGEN PRINCIPAL DEL PRODUCTO -------
    	if($request->file('image'))
    	{
    	    $deleted = Storage::disk('public')->delete($product->image);

    	    if(isset($deleted) || $product->image == null)
    	    {
    	        $path = $request->file('image')->store('public');

    	        $file = Str::replaceFirst('public/', '',$path);

    	        $product->update([
    	            'title' => $request->title,
    	            'description' =>$request->description,
    	            'price' => $request->price,
    	            'category_id' => $request->category_id,
                    'slug' => $request->slug,
    	            'image' => $file,
    	        ]);
    	    } else {
    	        return back()->with('message', 'No se pudo actualizar el producto');
    	    }
    	} else {
    	    $product->update([
    	        'title' => $request->title,
    	        'price' => $request->price,
    	        'category_id' => $request->category_id,
                'slug' => $request->slug,
    	        'description' =>$request->description,
    	    ]);
    	}

        //--------- AGREGAR IMAGENES SECUNDARIAS A PRODUCTO EXISTENTE -------
        if($request->file('second_image'))
        {
            foreach ($request->file('second_image') as $file) {
                $path_s = $file->store('public');
                $file_s = Str::replaceFirst('public/', '',$path_s);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file_s,
                ]);
            }
        }

        return back()->with('message', 'Producto actualizado con éxito');
    }

    public function eliminarProducto($id)
    {
    	$product = Product::find($id);


    	$deleted = Storage::disk('public')->delete($product->image);

    	if(isset($deleted) || $product->image == null)
    	{
    		$product->delete();

    		return back()->with('error', 'Producto eliminado con éxito');
    	}

    	return back()->with('error', 'No se pudo eliminar el producto');

    }

}
