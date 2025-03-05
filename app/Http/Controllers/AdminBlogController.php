<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::latest()->paginate(6)
        ]);
    }

    public function create()
    {
        if (auth()->guest() || !auth()->user()->is_admin) {
            abort(403);
        }

        return view('admin.blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $path = request()->file('thumbnail') ?
            request()->file('thumbnail')->store('thumbnails') : null;

        $formData = request()->validate([
            'title' => ['required', 'max:225'],
            'intro' => 'required',
            'slug' => ['required', Rule::unique('blogs', 'slug')],
            'body' => 'required',
            "category_id" => ["required", Rule::exists('categories', 'id')],
        ]);

        $formData['user_id'] = auth()->user()->id;
        $formData['thumbnail'] = $path;

        Blog::create($formData);

        return redirect('/admin/blogs')->with('success', 'Welcome ' . auth()->user()->name);
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }

    public function update(Blog $blog)
    {
        $formData = request()->validate([
            'title' => ['required', 'max:225'],
            'intro' => 'required',
            'slug' => ['required', Rule::unique('blogs', 'slug')->ignore($blog->id)],
            'body' => 'required',
            "category_id" => ["required", Rule::exists('categories', 'id')],
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Add validation for file
        ]);

        $formData['user_id'] = auth()->id();

        if (request()->hasFile('thumbnail')) {
            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            } // Delete old file
            $formData['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
        }

        $blog->update($formData);

        return redirect('/admin/blogs')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
