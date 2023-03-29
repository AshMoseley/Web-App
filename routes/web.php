<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

// post
Route::get('/forum/{forum}/thread', [ThreadController::class, 'index'])->name('posts.index');
Route::get('/forum/{forum}/thread/create', [ThreadController::class, 'create'])->name('posts.create');
Route::post('/forum/{forum}/thread', [ThreadController::class, 'store'])->name('posts.store');
Route::get('/forum/{forum}/thread/{thread}', [ThreadController::class, 'show'])->name('posts.show');

// Reply
Route::post('/forum/{forum}/thread/{thread}/reply', [ThreadController::class, 'reply'])->name('thread.reply');
Route::get('/forum/{forum}/thread/{thread}/reply/{reply}/edit', [ThreadController::class, 'editReply'])->name('thread.editReply');
Route::put('/forum/{forum}/thread/{thread}/reply/{reply}', [ThreadController::class, 'updateReply'])->name('thread.updateReply');
Route::delete('/forum/{forum}/thread/{thread}/reply/{reply}', [ThreadController::class, 'destroyReply'])->name('thread.destroyReply');

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
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
require __DIR__.'/auth.php';
