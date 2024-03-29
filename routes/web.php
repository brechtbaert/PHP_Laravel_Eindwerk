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
Route::get('/movieDetail/{movieId}','MovieController@movieDetail')->name('movieDetail');
Route::get('/editMovie/{movieId}','MovieController@editMovie')->name('editMovie');
Route::get('/newMovie','MovieController@newMovie')->name('newMovie');
Route::get('/addDirector','MovieController@addDirector')->name('addDirector');
Route::get('/addActor/{movieId}','MovieController@showAddActorToMovie')->name('showAddActorToMovie');
Route::get('/deleteMovie/{movieId}','MovieController@deleteMovie')->name('deleteMovie');


//director routes
Route::get('/allDirectors','DirectorController@showDirectors')->name('showDirectors');
Route::get('/editDirector/{directorId}','DirectorController@editDirector')->name('editDirector');
Route::get('/newDirector','DirectorController@newDirector')->name('newDirector');
route::get('/deleteDirector/{directorId}','DirectorController@deleteDirector')->name('deleteDirector');

//actor routes
Route::get('/allActors','ActorController@showActors')->name('showActors');
Route::get('/editActor/{actorId}','ActorController@editActor')->name('editActor');
Route::get('/newActor','ActorController@newActor')->name('newActor');
Route::get('/deleteActor/{actorId}','ActorController@deleteActor')->name('deleteActor');

//user routes
Route::get('/addReview/{movieId}','UserController@addReview')->name('addReview');


//authentication routes
Auth::routes();


//post routes
//movie routes
Route::post('/updateMovie','MovieController@updateMovie')->name('updateMovie');
Route::post('/insertMovie','MovieController@addNewMovie')->name('addNewMovie');
Route::post('/addDirector','MovieController@addDirectorToNewMovie')->name('addDirectorToNewMovie');
Route::post('/addActorMovie','MovieController@addActorMovie')->name('addActorMovie');

//director routes
Route::post('/updateDirector','DirectorController@updateDirector')->name('updateDirector');
Route::post('/insertDirector','DirectorController@addNewDirector')->name('addNewDirector');

//actor routes
Route::post('/updateActor','ActorController@updateActor')->name('updateActor');
Route::post('/insertActor','ActorController@addNewActor')->name('addNewActor');

//user routes
Route::post('/newReview','UserController@addNewReview')->name('newReview');
