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

Route::get('/', 'EventController@index');
Route::get('/home', 'EventController@home');
Route::post('/search', 'EventController@searchEvents');

Route::group(['middleware'=>'user-middleware'], function(){
   Route::get('/manage/{id}', 'EventController@manageEvents');
   Route::get('/manage/insert/{id}', 'EventController@manageInsert');
   Route::get('/manage/edit/{id}', 'EventController@manageEdit');

   Route::post('/events/save/{id}', 'EventController@saveEvents');
   Route::delete('/events/delete/{id}', 'EventController@deleteEvents');
   Route::post('/events/edit/{id}', 'EventController@editEvents');
});

Route::auth();


