<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;
use App\Product;
use App\Category;
use App\Publicidad;
use App\Configuraciones;
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
        $categorias = Category::with(['products'])->get();
        $publicidades = Publicidad::all();
        $small_products = Product::paginate(21);
        return view('landing', compact('sliders', 'logo', 'categorias', 'publicidades', 'small_products'));
    }


    public function products(Request $request)
    {

        if(isset($request->search))
        {
            $productos = Product::where('title', 'LIKE', '%'.$request->search.'%')->paginate(25);
        }else {
            $productos = Product::paginate(25);
        }
        
        $categorias = Category::all();
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

    public function showProductsByCategory($slug)
    {
        $product_categorie = Category::where('slug', $slug)->first();
        $categorias = Category::all();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        $productos = $product_categorie->products()->paginate(25);

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
