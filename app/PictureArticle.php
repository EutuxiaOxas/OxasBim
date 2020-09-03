<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PictureArticle extends Model
{
    protected $fillable = ['picture', 'article_id'];
}
