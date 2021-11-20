<?php

use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/post/{post}', [PostController::class, 'show'])->name('blog.show');
Route::get('/blog/categories/{category}', [PostController::class, 'category'])->name('blog.category');
Route::get('/blog/tags/{tag}', [PostController::class, 'tag'])->name('blog.tag');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/categories', 'CategoryController');

    Route::resource('/tags', 'TagController');

    Route::resource('/posts', 'PostController');

    Route::get('/trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('/restore-posts/{post}', 'PostController@restore')->name('restore-posts');

});


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/users', 'UsersControler@index')->name('users.index');
    Route::get('/users/profile', 'UsersControler@editProfile')->name('users.edit-profile');
    Route::put('/users/profile', 'UsersControler@updateProfile')->name('users.update-profile');
    Route::post('/users/{user}/make-admin', 'UsersControler@makeAdmin')->name('users.make-admin');
});
