<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $guarded = [];

    public function blog() // call blog_id
    {
        return $this->belongsTo(Blog::class);
    }
    public function author() // call user_id
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
