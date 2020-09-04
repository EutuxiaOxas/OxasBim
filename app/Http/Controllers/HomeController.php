<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;

use App\BlogArticle;
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
        $posts = BlogArticle::paginate(3);

        return view('blog.index', compact('posts'));
    }

    public function showPost($id)
    {
        $post = BlogArticle::find($id);
        $comments = $post->comments;
        return view('blog.post', compact('post', 'comments'));
    }
}
