<?php

namespace App\Http\Controllers\Cms\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BlogComment;
use App\BlogArticle;


class BlogCommentController extends Controller
{
    public function addComment(Request $request)
    {
    	BlogComment::create($request->all());

    	return response()->json('', 200);
    }

    public function getComments($id)
    {


    	$articulo = BlogArticle::find($id);

    	$comments = $articulo->comments;

    	return response()->json($comments, 200);
    }


    public function deleteComment($id)
    {
    	$comentario = BlogComment::find($id);
    	$comentario->delete();

    	return response()->json('', 200);
    }

}
