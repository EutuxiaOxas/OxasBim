<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;
use App\Product;
use App\Category;
use App\Publicidad;
use App\Configuraciones;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lading()
    {
        $sliders = Logo_Banner::where('tipo', 'banner')->where('status', 1)->get();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        $publicidades = Publicidad::all();
        $small_products = Product::inRandomOrder()->take(21)->get();
        $cantidad_otros_productos = 3;
        $categorias = Category::with(['products'])->get();
        //array donde estaran los array de productos por categoria
        $array_other_products = array();
        //recorro el array de categorias
        for ($i = 0; $i <= $cantidad_otros_productos; $i++) {
            if(isset($categorias[$i])){
                //obtengo los productos por categoria
                $product_cat = Product::inRandomOrder()->where('category_id', $categorias[$i]->id)->get();
                array_push($array_other_products,$product_cat);
            }else{
                break;
            }
        }
        return view('landing', compact('sliders', 'logo', 'categorias', 'publicidades', 'small_products', 'array_other_products'));
    }


    public function products(Request $request)
    {

        if(isset($request->search))
        {
            $productos = Product::inRandomOrder()->where('title', 'LIKE', '%'.$request->search.'%')->paginate(25);
        }else {
            $productos = Product::inRandomOrder()->paginate(25);
        }

        $categorias = Category::with(['products'])->get();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        return view('productos', compact('productos', 'categorias', 'logo'));
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->with('images')->first();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        $otros_products = Product::inRandomOrder()->take(6)->get();
        $m_pagos = Configuraciones::where('title', 'PAGO')->get();
        $m_envios = Configuraciones::where('title', 'ENVIO')->get();

        return view('ver_producto', compact('product', 'logo', 'otros_products', 'm_pagos', 'm_envios'));
    }

    public function showProductsByCategory(Request $request, $slug)
    {
        $product_categorie = Category::where('slug', $slug)->first();
        $categorias_hijo = Category::with(['products'])->where('padre_id', $product_categorie->id)->get();

        $categorias = Category::with(['products'])->get();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        $productos = [];

        foreach (Product::inRandomOrder()->where('category_id', $product_categorie->id)->get() as $producto) {
            $productos[] = $producto;
        }

        foreach ($categorias_hijo as $categoria) {
            foreach (Product::inRandomOrder()->where('category_id', $categoria->id)->get() as $producto) {
                $productos[] = $producto;
            }
        }



        $total= count($productos);
        $per_page = 25;
        $current_page = $request->input("page") ?? 1;

        $starting_point = ($current_page * $per_page) - $per_page;

        $productos = array_slice($productos, $starting_point, $per_page, true);

        $productos = new Paginator($productos, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);



        return view('productos', compact('productos', 'categorias', 'logo', 'product_categorie'));
    }

    // public function verCarrito()
    // {
    //     $logo = Logo_Banner::where('tipo', 'logo')->first();
    //     if(auth()->user())
    //     {
    //         $cart = auth()->user()->cartVerify();
    //         $cart_details = $cart->cartDetails()->with('product')->get();
    //         return view('carrito', compact('cart_details', 'logo'));
    //     }else {
    //         return view('carrito', compact('logo'));
    //     }
    // }
}
