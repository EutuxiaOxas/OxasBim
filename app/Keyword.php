<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['keyword'];

    public function articles()
    {
        return $this->belongsToMany('App\BlogArticle', 'article_keyword', 'keyword_id', 'article_id');
    }
}
