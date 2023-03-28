<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/AccessNotAllowed', 'HomeController@notAllowed');

Route::get('/delete_member/{id}', 'HomeController@delete_member');

Route::get('/post_detail/{id}', 'HomeController@show_post');

Route::get('/update_member/{id}', 'HomeController@update_member');

Route::post('/post_update/{id}', 'HomeController@post_update');


Route::group(['middleware' => ['secure']], function () {

    Route::post('/post_member', 'HomeController@post_member');

    Route::get('/add_member', 'HomeController@add_member');

    Route::get('/home', 'HomeController@index');

    Route::post('/post/store', 'HomeController@store')->name('post.store');

    Route::post('/comment/store', 'HomeController@store_comment')->name('comment.add');

    Route::post('/reply/store', 'HomeController@replyStore')->name('reply.add');

    Route::get('todos/{todo}/edit', 'TodoController@todo_edit');

    Route::post('todos_store', 'TodoController@todo_store')->name('todos.store');

    Route::delete('todos/destroy/{todo}', 'TodoController@destroy');

    Route::get('/post/update/{id}', 'HomeController@update_post')->name('update.post');

    Route::post('/fetch/post/update/{id}', 'HomeController@update')->name('p.update');

    Route::get('/add/article', 'HomeController@add_article')->name('add.article');

    Route::post('store/article', 'HomeController@store_article')->name('store.article');

    Route::get('show/article', 'HomeController@show_article')->name('show.article');

    Route::get('read/article/{id}', 'HomeController@article_detail')->name('article.detail');

    Route::post('/review.store/{id}', 'HomeController@store_review')->name('review.store');

    Route::post('/store.replies/{id}', 'HomeController@store_replies');

});
Route::group(['middleware' => ['AdminRoutes']], function () {

    Route::get('/add/todo', 'HomeController@add_todo');
    Route::get('/create_post', 'HomeController@create')->name('post.create');
    Route::get('/all_post', 'HomeController@all_post')->name('post.show');
    Route::get('/user/make/admin', 'HomeController@make_admin')->name('make.admin');
    Route::get('/user/change/role/{id}', 'HomeController@change_role')->name('change.role');
    Route::get('/user/delete/user/{id}', 'HomeController@delete_user')->name('delete.user');

});