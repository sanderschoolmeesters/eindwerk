<?php

use Illuminate\Support\Facades\Route;

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

//->middleware('auth'); == enkel toegankelijk wanneer ingelogged
//->middleware('auth', auth.user/admin); == enkel toegankelijk voor user of admin, check middleware (admin, user)

Route::get('/', function () {
    return view('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/userTicket', 'UserController@makeTicket')->middleware(['auth', 'auth.user']);

Route::get('/userTickets', 'UserController@showTickets')->middleware(['auth', 'auth.user']);

Route::get('/userProfile', 'UserController@showProfile')->middleware(['auth', 'auth.user']);

Route::get('/adminTicket', 'AdminController@showTicket')->middleware(['auth', 'auth.admin']);

Route::get('/adminProfile', 'AdminController@showProfile')->middleware('auth');

Route::post('/adminProfile', 'AdminController@editImage')->middleware('auth');

Route::post('/adminProfile/review/{user_id}', 'AdminController@review')->middleware('auth');

Route::get('/chatAdmin/{ticket_id}', 'AdminController@chatAdmin');

Route::post('/chatAdmin/{ticket_id}', 'AdminController@sendChat');

Route::delete('/chatAdmin/{ticket_id}', 'AdminController@deleteChat');

Route::get('/adminProfile/guest/{user_id}', 'AdminController@adminProfileGuest');

Route::get('/adminReviews/{user_id}', 'AdminController@showReviewsForAdmin')->middleware(['auth', 'auth.admin']);

Route::get('/admin', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

