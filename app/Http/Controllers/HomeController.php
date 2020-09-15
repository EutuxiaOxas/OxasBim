<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;

use App\BlogArticle;
use App\BlogCategorie;
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


    public function blog()
    {
        $posts = BlogArticle::orderBy('id', 'DESC')->paginate(15);
        $categorias = BlogCategorie::all();
        return view('blog.index', compact('posts', 'categorias'));
    }

    public function showPost($slug)
    {
        $post = BlogArticle::where('slug', $slug)->first();
        $comments = $post->comments;
        return view('blog.post', compact('post', 'comments'));
    }

    public function blogByCategories($name)
    {
        
        $categoria = BlogCategorie::where('name', $name)->first();
        $posts = BlogArticle::where('category_id', $categoria->id)->paginate(15);
        $categorias = BlogCategorie::all();
        return view('blog.index', compact('posts', 'categorias'));
    }

}
