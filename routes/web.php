<?php

// use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
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
// Forum Admin

Route::group(['middleware' => 'admin'], function () {
    Route::post('/forums', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forums/create', [ForumController::class, 'create'])->name('forum.create');
    Route::get('/forums/{forum}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/forums/{forum}', [ForumController::class, 'update'])->name('forum.update');
});


// post
Route::get('/forums/{forum}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/forums/{forum}/post', [PostController::class, 'index'])->name('posts.index');
Route::get('/forums/{forum}/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/forums/{forum}/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/forums/{forum}/post/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/forums/{forum}/post/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::delete('/forums/{forum}/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Tags
Route::get('/tags/{tag}', 'TagController@show')->name('tags.show');



// admin
// Route::get('/posts/{post}/edit', 'PostController@edit')->middleware('admin');
// Route::put('/posts/{post}', 'PostController@update')->middleware('admin');
// Route::get('/comments/{comment}/edit', 'CommentController@edit')->middleware('admin');
// Route::put('/comments/{comment}', 'CommentController@update')->middleware('admin');


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
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/users/{user}/posts', [ProfileController::class, 'posts'])->name('users.posts');


// Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Contact
// Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
require __DIR__.'/auth.php';
