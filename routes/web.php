<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
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

Route::get('/', action: [BlogController::class, 'index']);

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

Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('guest');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'post_login'])->middleware('guest');

//admin routes
Route::middleware('can:admin')->group(function () {
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
    Route::post('/admin/blogs/store', [AdminBlogController::class, 'store']);
    Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update']);
    Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destroy']);
    Route::get('/admin/blogs', [AdminBlogController::class, 'index']);
});
