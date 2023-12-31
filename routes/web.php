<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use Illuminate\Http\Request;
use App\Http\Controllers\CommentController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/post', function() {
    $posts = (new PostController)->getAllPosts();
    $postsById = (new PostController)->getPostsByUserId(auth()->user()->id);

    return view('post', ['posts' => $posts, 'postsById' => $postsById]);
});

Route::post('/newPost', [PostController::class, 'savePost'])->name('newPost');
Route::post('/newComment', [CommentController::class, 'saveComment'])->name('newComment');

Route::get('/likeOrDislike/{postId}', [LikeController::class, 'likeOrDislike'])->name('likeOrDislike');
Route::get('user/followOrUnfollow/{userId}', [FollowController::class, 'followOrUnfollow'])->name('followOrUnfollow');


Route::get('user/{userId}', function($userId){
    $user = (new ProfileController)->showUser($userId);

    return view('userProfile', ['user' => $user]);
});

Route::get('/feed', function() {
    $posts = (new PostController)->getAllPosts();

    return view('feed', ['posts' => $posts]);
});

Route::get('/postcreation', function() {
    return view('postcreation', []);
})->middleware(['auth', 'verified'])->name('postcreation');

require __DIR__.'/auth.php';