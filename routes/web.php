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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
  Route::group(['middleware' => ['role:event_manager']], function () {
    Route::resource('events', 'EventsController')->except(['show']);
    Route::prefix('events')->group(function(){
      Route::put('/approve/{uid}/{id}','EventsController@approve');
      Route::put('/unapprove/{uid}/{id}','EventsController@unapprove');
      Route::put('/publish/{id}','EventsController@publish');
      Route::put('/unpublish/{id}','EventsController@unpublish');
      Route::put('/remove/{uid}/{id}','EventsController@remove');
    });
  });
  Route::group(['middleware' => ['role:bourse_manager']], function () {
    Route::resource('bourses', 'BoursesController')->except( ['show']);
    Route::prefix('bourses')->group(function(){
      Route::put('/approve/{uid}/{id}','BoursesController@approve');
      Route::put('/unapprove/{uid}/{id}','BoursesController@unapprove');
      Route::put('/publish/{id}','BoursesController@publish');
      Route::put('/unpublish/{id}','BoursesController@unpublish');
      Route::put('/remove/{uid}/{id}','BoursesController@remove');
    });
  });
  Route::group(['middleware' => ['role:conference_manager']], function () {
    Route::resource('conferences', 'ConferencesController')->except( ['show']);
    Route::prefix('conferences')->group(function(){
      Route::put('/approve/{uid}/{id}','ConferencesController@approve');
      Route::put('/unapprove/{uid}/{id}','ConferencesController@unapprove');
      Route::put('/publish/{id}','ConferencesController@publish');
      Route::put('/unpublish/{id}','ConferencesController@unpublish');
      Route::put('/remove/{uid}/{id}','ConferencesController@remove');
    });
  });
  Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('users', 'UsersController')->except(['create', 'store']);
  });
  Route::get('/','HomeController@index')->name('index');
  Route::get('/home','HomeController@index');
  Route::prefix('events')->group(function(){
    Route::get('/myevents','EventsController@myEvents')->name('myevents');
    Route::put('/subscribe/{id}','EventsController@subscribe');
    Route::get('/{id}','EventsController@show');
  });
  Route::prefix('bourses')->group(function(){
    Route::get('/mybourses','BoursesController@myBourses')->name('mybourses');
    Route::put('/subscribe/{id}','BoursesController@subscribe');
    Route::get('/{id}','BoursesController@show');
  });
  Route::prefix('conferences')->group(function(){
    Route::get('/myconferences','ConferencesController@myConferences')->name('myconferences');
    Route::put('/subscribe/{id}','ConferencesController@subscribe');
    Route::get('/{id}','ConferencesController@show');
  });
  Route::resource('apply', 'BoursesAppController');
});
