<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content', 'id_user', 'show_post', 'id_first_post', 'id_parent_post'
    ];

    public function user()
    {
        return $this->belongsTo('user', 'user_id');
    }
}