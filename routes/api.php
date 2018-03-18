<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function () {
    return App\Article::find(1)->tags;
});
Route::group(['namespace'=>'Api','middleware'=>['auth:api','admin']],function (){
    Route::resource('article','ArticleController');
    Route::resource('comment','CommentController');
    Route::resource('category','CategoryController');
    Route::resource('tag','TagController');
    Route::resource('user','UserController');
    Route::resource('image','ImageController');
    Route::resource('discussion','DiscussionController');
    Route::get('all-article','ArticleController@getAll');
    Route::get('table-type','CommentController@getTableType');
    Route::get('all-discussion','DiscussionController@getAll');
    Route::post('ca-comment','ArticleController@createComments');
    Route::post('cd-comment','DiscussionController@createComments');
    Route::get('dashboard','ArticleController@dashboardCount');
});
