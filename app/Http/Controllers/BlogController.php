<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs', [
            'blogs' => Blog::all()
        ]);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs', ['blog' => $blog]);
    }

    public function create()
    {
        return view('create-blog');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }
}
