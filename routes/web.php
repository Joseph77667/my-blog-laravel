<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

// Route::get('/', [BlogController::class, 'index']);

//  Route::controller(BlogController::class)->group(function(){
// //     Route::get('/blogs', 'show');
//     Route::post('/blogs/store', 'store');
// //     Route::patch('blogs/update', 'update');
// //     Route::delete('blogs/delete', 'delete');
// });

Route::get('/',[BlogController::class, 'index'] );

Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);

// Route::get('/categories/{categories:slug}', function (Category $categories) {
//     return view('blogs', [
//         'blogs' => $categories->blogs//->load('category', 'author')
//     ]);
// });

// Route::get('/users/{user:username}', function(User $user){
//     return view('blogs',[
//         'blogs' => $user->blogs
//     ]);
// });


Route::get('/add', function(){
    return view('create');
});