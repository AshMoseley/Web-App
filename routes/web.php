<?php

// use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');



// Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forum.show');

// post
Route::get('/forum/{forum}/post', [PostController::class, 'index'])->name('posts.index');
Route::get('/forum/{forum}/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/forum/{forum}/post', [PostController::class, 'store'])->name('posts.store');
Route::get('/forum/{forum}/post/{post}', [PostController::class, 'show'])->name('posts.show');

// Reply
Route::post('/forum/{forum}/post/{post}/reply', [PostController::class, 'reply'])->name('thread.reply');
Route::get('/forum/{forum}/post/{post}/reply/{reply}/edit', [PostController::class, 'editReply'])->name('thread.editReply');
Route::put('/forum/{forum}/post/{post}/reply/{reply}', [PostController::class, 'updateReply'])->name('thread.updateReply');
Route::delete('/forum/{forum}/post/{post}/reply/{reply}', [PostController::class, 'destroyReply'])->name('thread.destroyReply');

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
