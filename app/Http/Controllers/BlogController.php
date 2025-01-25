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
            return view('blogs',[
                'blogs' =>Blog::latest()->filter(request(['search','category','username']))->paginate(6),
                // 'categories'=>Category::all()//with('category','author')->get()
            ]);
    }

    public function show(Blog $blog) {
        return view('blog',[
            'blog'=>$blog,
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required','max:225'],
            'intro' => 'required',
            'slug' => ['required',Rule::unique('blogs','slug')],
            'body' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->intro = $validatedData['intro'];
        $blog->slug = $validatedData['slug'];
        $blog->body = $validatedData['body'];
        $blog->save();

        return redirect()->route('blogs')->with('success', 'Blog created successfully.');
    }

    public function update(Request $request){

    }

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

