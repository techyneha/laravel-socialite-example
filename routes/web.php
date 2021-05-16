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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','PagesController@index');
// Route::get('/about','PagesController@aboutus');
Route::get('/service','PagesController@services');

Route::resource('posts','PostsController');

Route::resource('about','AboutController');

/*Route::get('/hello', function () {
    return "Hello World";
});*/	


Auth::routes();

Route::get('/home', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

// Route::get('/dashboard', 'DashboardController@index')->middleware('role:editor,approver');
// Route::get('/dashboard', 'DashboardController@index_new')->middleware('role:admin');