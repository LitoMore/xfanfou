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
    Route::get('login', 'LoginController@getLogin')->name('M.getLogin');
    Route::get('home', 'HomeController@getHome')->name('M.getHome');
    Route::post('home', 'HomeController@postHome')->name('M.postHome');
    Route::get('mentions', 'MentionsController@mentions')->name('M.mentions');
    Route::get('msg.reply/{msg_id}', 'MsgController@reply')->name('M.msg.reply');
    Route::get('msg.forward/{msg_id}', 'MsgController@forward')->name('M.msg.forward');
    Route::get('msg.del/{msg_id}', 'MsgController@del')->name('M.msg.del');
    Route::get('msg.favorite.add/{msg_id}', 'MsgController@favoriteAdd')->name('M.msg.favorite.add');
    Route::get('msg.favorite.del/{msg_id}', 'MsgController@favoriteDel')->name('M.msg.favorite.del');
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
    // Blocks
    Route::get('blocks/ids', 'BlocksController@getIds');
    Route::get('blocks/blocking', 'BlocksController@getBlocking');
    Route::post('blocks/create', 'BlocksController@postCreate');
    Route::get('blocks/exists', 'BlocksController@getExists');
    Route::post('blocks/destroy', 'BlocksController@postDestroy');
    // Users
    Route::get('users/tagged', 'UsersController@getTagged');
    Route::get('users/show', 'UsersController@getShow');
    Route::get('users/tag_list', 'UsersController@getTagList');
    Route::get('users/followers', 'UsersController@getFollowers');
    Route::get('users/recommendation', 'UsersController@getRecommendation');
    Route::post('users/cancel_recommendation', 'UsersController@postRecommendation');
    Route::get('users/friends', 'UsersController@getFriends');
    // Account
    Route::get('account/verify_credentials', 'AccountController@getVerifyCredentials');
    Route::post('account/verify_credentials', 'AccountController@postVerifyCredentials');
    Route::post('account/update_profile_image', 'AccountController@postUpdateProfileImage');
    Route::get('account/rate_limit_status', 'AccountController@getRateLimitStatus');
    Route::post('account/update_profile', 'AccountController@postUpdateProfile');
    Route::get('account/notification', 'AccountController@getNotification');
    Route::get('account/update_notify_num', 'AccountController@postUpdateNotifyNum');
    Route::get('account/notify_num', 'AccountController@getNotifyNum');
    // Saved Searches
    Route::post('saved_searches/create', 'SavedSearchesController@postCreate');
    Route::post('saved_searches/destroy', 'SavedSearchesController@postDestroy');
    Route::get('saved_searches/show', 'SavedSearchesController@getShow');
    Route::get('saved_searches/list', 'SavedSearchesController@getList');
    // Photos
    Route::get('photos/user_timeline', 'PhotosController@getUserTimeline');
    Route::post('photos/upload', 'PhotosController@postUpload');
    // Trends
    Route::get('trends/list', 'TrendsController@getList');
    // Followers
    Route::get('followers/ids', 'FollowersController@getIds');
    // Favorites
    Route::post('favorites/destroy', 'FavoritesController@postDestroy');
    Route::get('favorites/id', 'FavoritesController@getId');
    Route::post('favorites/create', 'FavoritesController@postCreate');
    // Friendships
    Route::post('friendships/create', 'FriendshipsController@postCreate');
    Route::post('friendships/destroy', 'FriendshipsController@postDestroy');
    Route::get('friendships/requests', 'FriendshipsController@getRequests');
    Route::post('friendships/deny', 'FriendshipsController@postDeny');
    Route::get('friendships/exists', 'FriendshipsController@getExists');
    Route::post('friendships/accept', 'FriendshipsController@postAccept');
    Route::get('friendships/show', 'FriendshipsController@getShow');
    // Friends
    Route::get('friends/ids', 'FriendsController@getIds');
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
    // Direct Messages
    Route::post('direct_messages/destroy', 'DirectMessagesController@postDestroy');
    Route::get('direct_messages/conversation', 'DirectMessagesController@getConversation');
    Route::post('direct_messages/new', 'DirectMessagesController@postNew');
    Route::get('direct_messages/conversation_list', 'DirectMessagesController@getConversationList');
    Route::get('direct_messages/inbox', 'DirectMessagesController@getInbox');
    Route::get('direct_messages/sent', 'DirectMessagesController@getSent');
});

Route::get('/', function () {
    return view('welcome');
});
