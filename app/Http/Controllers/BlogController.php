<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
    public function home()
    {
        return view('components.home', [
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

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function subscriptionHandler(Blog $blog){

        if (User::find(auth()->id())->isSubscribed($blog)){
            $blog->unSubscribed();
        }else{
            $blog->subscribed();
        }

        return back();


        //auth()->user()->isSubscribed($blog)
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
