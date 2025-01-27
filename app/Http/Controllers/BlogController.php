<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::latest()
                ->filter(request(['search', 'category', 'username']))
                ->paginate(6)
                ->withQueryString(),
            // 'categories'=>Category::all()//with('category','author')->get()
        ]);
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', [
            'blog' => $blog,
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    public function create()
    {
        return view('blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $path = request()->file('thumbnail') ? request()->file('thumbnail')->store('thumbnails') : null;

        $formData = request()->validate([
            'title' => ['required', 'max:225'],
            'intro' => 'required',
            'slug' => ['required', Rule::unique('blogs', 'slug')],
            'body' => 'required',
            "category_id" => ["required", Rule::exists('categories', 'id')],
        ]);

        $formData['user_id'] = \Illuminate\Support\Facades\Auth::user()->id; // Add user_id to the validated data
        $formData['thumbnail'] = $path;

        Blog::create($formData); // Create the blog post with validated data

        return redirect('/');
    }

    public function update(Request $request) {}

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // protected function getBlogs(){
    //     // $query=Blog::latest();
    //     //      if(request('search')){
    //     //          $blogs=$blogs->where('title','LIKE','%'.request('search').'%')
    //     //                     ->orWhere('body','LIKE','%'.request('search').'%');
    //     //      }
    //     // $query->when(request('search'), function ($query, $search){
    //     //     $query->where('title','LIKE','%'.$search.'%')
    //     //                      ->orWhere('body','LIKE','%'.$search.'%');
    //     // });
    //     // return $query->get();
    //     return Blog::latest()->filter()->get();
    // }
}
