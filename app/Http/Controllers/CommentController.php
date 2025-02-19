<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController
{
    public function store(Blog $blog){
        //@dd(request()->all());

        $formData = request()->validate([
            'body' => 'required'
        ]);

        $blog->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id()
            
        ]);
        return redirect('/blogs/'.$blog->slug);
    }
}
