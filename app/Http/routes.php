<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('fanfou', 'Auth\FanfouController@index');
Route::get('fanfou/callback', 'Auth\FanfouController@callback');
Route::post('fanfou/login', 'Auth\FanfouController@login');

Route::group([
    'namespace' => 'Home\M',
    'middleware' => 'auth.fanfou',
    'domain' => 'm.xfanfou.com'
], function () {
    Route::get('home', 'HomeController@getHome')->name('M.getHome');
    Route::post('home', 'HomeController@postHome')->name('M.postHome');
    Route::get('mentions', 'MentionsController@mentions')->name('M.mentions');
    Route::get('msg.reply/{msg_id}', 'MsgController@reply')->name('M.msg.reply');
    Route::get('msg.forward/{msg_id}', 'MsgController@forward')->name('M.msg.forward');
});

Route::group([
    'namespace' => 'Api',
    'middleware' => 'auth.fanfou',
    'domain' => 'api.{x}fanfou.{com}'
], function () {
    // Search
    Route::get('search/public_timeline', 'SearchController@getPublicTimeline');
    Route::get('search/users', 'SearchController@getPublicTimeline');
    Route::get('search/user_timeline', 'SearchController@getUserTimeline');

    // Statuses
    Route::get('statuses/home_timeline', 'StatusesController@getHomeTimeline');
    Route::get('statuses/public_timeline', 'StatusesController@getPublicTimeline');
    Route::get('statuses/replies', 'StatusesController@getReplies');
    Route::get('statuses/followers', 'StatusesController@getFollowers');
    Route::post('statuses/update', 'StatusesController@postUpdate');
    Route::get('statuses/user_timeline', 'StatusesController@getUserTimeline');
    Route::get('statuses/friends', 'StatusesController@getFriends');
    Route::get('statuses/context_timeline', 'StatusController@getContextTimeline');
    Route::get('statuses/mentions', 'StatusesController@getMentions');
    Route::get('statuses/show', 'StatusesController@getShow');
});

Route::get('/', function () {
    return view('welcome');
});
