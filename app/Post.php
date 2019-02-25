<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'id_user', 'show_post', 'id_first_post', 'id_parent_post'
    ];
}