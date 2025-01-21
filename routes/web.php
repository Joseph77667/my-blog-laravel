<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::get('/', [BlogController::class, 'index']);

Route::controller(BlogController::class)->group(function(){
    Route::get('/blogs', 'show');
});

