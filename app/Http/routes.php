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

Route::get('/', function () {
    return view('welcome');
});

Route::get('fanfou', 'Auth\FanfouController@index');
Route::get('fanfou/callback', 'Auth\FanfouController@callback');
Route::post('fanfou/login', 'Auth\FanfouController@login');

Route::group([
    'namespace' => 'Home',
    'middleware' => 'auth.fanfou',
    'domain' => 'm.xfanfou.dev'
], function () {
    Route::get('home', 'MController@home');
    Route::post('home', 'MController@home');
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
});


