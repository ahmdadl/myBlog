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

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Post;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/res/img/{image}', function ($image) {
    return redirect(asset('storage/storage/img/'. $image));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index');
Route::get('/posts/q/{title}', 'PostController@search');
// api routes
Route::resource('/api/posts', 'PostApiController');


// json routes
Route::get('/json/posts', function (Request $request) {
    return new PostCollection(Post::latest()->get());
});
Route::get('/json/posts/{post}', function (Post $post) {
    return new PostResource($post);
});

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
Route::post(
    'posts/{post}/comments/{comment}',
    'CommentController@addReplay'
);
Route::delete(
    'posts/{post}/comments/{comment}',
    'CommentController@destroy'
);

Route::post('/posts/{post}/tasks', 'TaskController@store')
    ->middleware('auth');
Route::patch('/posts/{post}/tasks/{task}', 'TaskController@update')
    ->middleware('auth');