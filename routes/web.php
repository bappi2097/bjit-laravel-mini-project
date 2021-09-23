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


Route::get('/', 'HomeController@index');

Route::group(["as" => 'category.', "prefix" => 'category', "middleware" => ["auth"]], function () {
    Route::get('/', "CategoryController@index")->name('index');
    Route::post('/store', "CategoryController@store")->name('store');
    Route::get('/edit/{category}', "CategoryController@edit")->name('edit');
    Route::put('/{category}', "CategoryController@update")->name('update');
    Route::delete('{category}', "CategoryController@destroy")->name('destroy');
});

Route::group(["as" => 'post.', "prefix" => 'post', "middleware" => ["auth"]], function () {
    Route::get('/', "PostController@index")->name('index');
    Route::get('/create', "PostController@create")->name('create');
    Route::post('/store', "PostController@store")->name('store');
    Route::get('/edit/{post}', "PostController@edit")->name('edit');
    Route::put('/{post}', "PostController@update")->name('update');
    Route::delete('{post}', "PostController@destroy")->name('destroy');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
