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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index');
Route::get('/posts/q/{title}', 'PostController@search');

Route::resource('posts', 'PostController', [
    'except' => ['index', 'search']
])->middleware('auth');

Route::get('category/create', 'CategoryController@create')
    ->middleware('auth', 'create.category');
Route::get('category/{category}', 'CategoryController@show');
Route::post('category', 'CategoryController@store')
    ->middleware('auth', 'create.category');


// add new category to post
Route::post(
    '/posts/{post}/addCategory',
    'PostController@storeCategory'
);

// invite new users for post
Route::post('/posts/{post}/invite', 'PostController@addUser');

Route::post('posts/{post}/comments', 'CommentController@store')
    ->middleware('auth');
