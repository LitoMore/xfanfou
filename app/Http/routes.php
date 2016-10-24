<?php

Route::get('fanfou', 'Auth\FanfouController@index');
Route::get('fanfou/callback', 'Auth\FanfouController@callback');
Route::post('fanfou/login', 'Auth\FanfouController@login');

Route::group([
    'namespace' => 'Home\M',
    'middleware' => 'auth.fanfou',
    'domain' => 'm.xfanfou.com'
], function () {
    Route::get('/', 'HomeController@getIndex');
    Route::get('login', 'LoginController@getLogin')->name('M.getLogin');
    Route::get('home', 'HomeController@getHome')->name('M.getHome');
    Route::get('home/p.{page}', 'HomeController@getHome')->name('M.getHomePage');
    Route::post('home', 'HomeController@postHome')->name('M.postHome');
    Route::get('mentions', 'MentionsController@mentions')->name('M.mentions');
    Route::get('mentions/p.{page}', 'MentionsController@mentions')->name('M.getMentionsPage');
    Route::get('msg.reply/{msg_id}', 'MsgController@reply')->name('M.msg.reply');
    Route::get('msg.forward/{msg_id}', 'MsgController@forward')->name('M.msg.forward');
    Route::get('msg.del/{msg_id}', 'MsgController@del')->name('M.msg.del');
    Route::get('msg.favorite.add/{msg_id}', 'MsgController@favoriteAdd')->name('M.msg.favorite.add');
    Route::get('msg.favorite.del/{msg_id}', 'MsgController@favoriteDel')->name('M.msg.favorite.del');
    Route::get('{user_id}', 'UserController@getUser')->name('M.getUser');
    Route::get('{user_id}/p.{page}', 'UserController@getUser')->name('M.getUserPage');
});

Route::get('/', function () {
    return view('welcome');
});
