<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;
use App\Product;
use App\Category;
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
        return view('landing', compact('sliders', 'logo'));
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

        return view('ver_producto', compact('product', 'logo'));
    }

    public function showProductsByCategory($slug)
    {
        $product_categorie = Category::where('slug', $slug)->first();
        $categorias = Category::all();
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        $productos = $product_categorie->products()->paginate(25);

        return view('productos', compact('productos', 'categorias', 'logo', 'product_categorie'));
    }

    public function verCarrito()
    {
        $logo = Logo_Banner::where('tipo', 'logo')->first();
        if(auth()->user())
        {
            $cart = auth()->user()->cartVerify();
            $cart_details = $cart->cartDetails()->with('product')->get();
            return view('carrito', compact('cart_details', 'logo'));
        }else {
            return view('carrito', compact('logo'));
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        $ordenes = $user->orders()->where('status', '!=', 'CANCELADO')->orderBy('id', 'DESC')->paginate(3);
        return view('home', compact('user', 'ordenes'));
    }
}
