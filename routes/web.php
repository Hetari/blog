<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// Posts routes
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('post.comment');
Route::put('/posts/{post}/comment/edit/{comment}', [PostController::class, 'editComment'])->name('posts.comment.edit');
Route::delete('/comments/{comment}', [PostController::class, 'deleteComment'])->name('comments.delete');

// Categories routes
Route::get('/categories/{category:slug}', [CategoryController::class, 'index'])->name('categories');


// Users routes
Route::get('/users/{user:username}', [PostController::class, 'userPosts'])->name('users.posts');

// About route
Route::get('/about', function () {
    return Inertia::render('About/About', []);
});
