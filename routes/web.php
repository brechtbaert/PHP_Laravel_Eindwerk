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

//get routes
//movie routes
Route::get('/','MovieController@showMovies')->name('showMovies');
Route::get('/editMovie/{movieId}','MovieController@editMovie')->name('editMovie');
Route::get('/newMovie','MovieController@newMovie')->name('newMovie');
Route::get('/deleteMovie/{movieId}','MovieController@deleteMovie')->name('deleteMovie');

//director routes
Route::get('/editDirector/{directorId}','DirectorController@editDirector')->name('editDirector');
Route::get('/newDirector','DirectorController@newDirector')->name('newDirector');
route::get('/deleteMovie','DirectorController@deleteDirector')->name('deleteMovie');


//authentication routes
Auth::routes();

//post routes
//movie routes
Route::post('/updateMovie','MovieController@updateMovie')->name('updateMovie');
Route::post('/insertMovie','MovieController@addNewMovie')->name('addNewMovie');


//director routes
Route::post('/updateDirector','DirectorController@updateDirector')->name('updateDirector');
Route::post('/insertDirector','DirectorController@addNewDirector')->name('addNewDirector');

