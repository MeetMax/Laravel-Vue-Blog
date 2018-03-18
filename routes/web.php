<?php


Route::get('/','ArticleController@index');

Auth::routes();
Route::get('/catalog','CatalogController@index');
Route::get('/category/{name}','CategoryController@index');
Route::get('/tag/{name}/article','TagController@getArticleByTag');
Route::get('/tag/{name}/discussion','TagController@getDiscussionByTag');
Route::get('/article/{id}','ArticleController@show')->where('id','[/\d+]*');
Route::get('/discussion','DiscussionController@index');
Route::get('/discussion/{id}','DiscussionController@show')->where('id','[/\d+]*');
Route::get('/discussion/create','DiscussionController@create');
Route::post('/discussion','DiscussionController@store');
Route::post('/comment','CommentController@store');
Route::get('/test',function (){
    return App\Article::find(1)->tags;
});
Route::group(['prefix' => 'dashboard','middleware'=>['auth','admin']], function () {
    Route::get('{path?}', 'DashboardController@index')->where('path', '[\/\w\.-]*');
});