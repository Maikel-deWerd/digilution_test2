<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

Route::get('/', [PostController::class, 'index']); 

Route::get('/source', function () {
    return view('welcome');
}); 

Route::get('posts/{post:slug}', [PostController::class, 'show']);//->where("post", "[A-z+\-]+");
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']); 

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('admin/posts/create', [PostController::class, 'create'])->middleware('admin');
Route::post('admin/pots/create', [PostController::class, 'store'])->middleware('admin');

Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');

// Route::get('categories/{category:slug}', function (Category $category) {
//     return view('posts', [ 
//         "posts" => $category->posts,
//         'currentCategory' => $category,
//         'categories' => Category::all()]);
// });

// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts.index', [ 
//         "posts" => $author->posts
//         // 'categories' => Category::all()
//     ]);
// });