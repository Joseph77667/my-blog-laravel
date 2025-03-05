<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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
Route::get('/home', action: [BlogController::class, 'home']);
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);

Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);
Route::post('/blogs/{blog:slug}/subscription', [BlogController::class, 'subscriptionHandler']);

Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'post_login'])->middleware('guest');

Route::get('/user/{user:id}/edit', [AdminUserController::class, 'editAvatar'])->name('user.edit');
    Route::post('/user/{user:id}/update-avatar', [AdminUserController::class, 'updateAvatar'])->name('user.update_avatar');

//admin routes
Route::middleware('can:admin')->group(function () {
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
    Route::post('/admin/blogs/store', [AdminBlogController::class, 'store']);
    Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update']);
    Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destroy']);
    Route::get('/admin/blogs', [AdminBlogController::class, 'index']);

    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/users/create', [AdminUserController::class, 'create']);
    Route::post('/admin/users/store', [AdminUserController::class, 'store']);
    Route::get('/admin/users/{user:name}/edit', [AdminUserController::class, 'edit']);
    Route::patch('/admin/users/{user:name}/update', [AdminUserController::class, 'update']);
    Route::delete('/admin/users/{user:name}/delete', [AdminUserController::class, 'destroy']);
});

