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

Route::group(['middleware' => 'auth.fanfou'], function () {
    Route::get('search/public_timeline', 'Api\SearchController@getPublicTimeline');
});
