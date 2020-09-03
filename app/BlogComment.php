<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = ['comment', 'article_id', 'status_id', 'reader_id'];
}
