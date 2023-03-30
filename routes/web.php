<?php

// use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Forum
Route::get('/forums', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forum.show');

// post
Route::get('/forums/{forum}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/forums/{forum}/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/forums/{forum}/post', [PostController::class, 'store'])->name('posts.store');
Route::put('/forums/{forum}/post/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::delete('/forums/{forum}/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// Comments
Route::post('/forum/{forum}/post/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/forum/{forum}/post/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/forum/{forum}/post/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/forum/{forum}/post/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// profile
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Contact
// Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
require __DIR__.'/auth.php';
