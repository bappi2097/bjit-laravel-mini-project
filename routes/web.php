<?php

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

Route::get('/', 'HomeController@index')->middleware('verified');

Route::group(["as" => 'profile.', "prefix" => 'profile', "middleware" => ["auth", "verified"]], function () {
    Route::get('/', "ProfileController@show")->name('show');
    Route::get('/edit', "ProfileController@edit")->name('edit');
    Route::put('/', "ProfileController@update")->name('update');
});

Route::group(["as" => 'category.', "prefix" => 'category', "middleware" => ["auth", "admin", "verified"]], function () {
    Route::get('/', "CategoryController@index")->name('index');
    Route::post('/store', "CategoryController@store")->name('store');
    Route::get('/edit/{category}', "CategoryController@edit")->name('edit');
    Route::put('/{category}', "CategoryController@update")->name('update');
    Route::delete('{category}', "CategoryController@destroy")->name('destroy');
});

Route::get('/category-posts/{slug}', "CategoryController@categoryPosts")->name('category-posts');

Route::group(["as" => 'post.', "prefix" => 'post', "middleware" => ["auth", "verified"]], function () {
    Route::get('/', "PostController@index")->name('index');
    Route::get('/single/{slug}', 'PostController@show')->name('show');
    Route::get('/create', "PostController@create")->name('create');
    Route::post('/store', "PostController@store")->name('store');
    Route::middleware('auth')->group(function () {
        Route::get('/edit/{post}', "PostController@edit")->name('edit');
        Route::put('/{post}', "PostController@update")->name('update');
        Route::delete('{post}', "PostController@destroy")->name('destroy');
    });
});

Route::redirect('/home', '/')->name('home')->middleware('verified');

Auth::routes(['verify' => true]);
