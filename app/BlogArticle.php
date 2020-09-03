<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    protected $fillable = ['title', 'content', 'picture', 'keywords', 'autor_id', 'category_id'];
}
