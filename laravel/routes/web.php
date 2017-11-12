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

Route::get('/', function () {
    return view('projetrapide');
});




Route::post('/taches', 'TacheController@store');


Route::get('/taches', 'TacheController@index');
Route::delete('/taches/{id}', 'TacheController@destroy');

Route::post('/sprints', 'SprintController@store');


Route::get('/acteurs',  array('as'=> 'acteurs', 'uses' => 'acteurs@index'));


Route::post('/listes',  array( 'uses' => 'ListeController@store'));
Route::post('/sprintactivite/store',  array( 'uses' => 'SprintActiviteController@store'));



Route::resource('acteurs', 'ActeurController');
Route::resource('taches', 'TacheController');
Route::resource('listes', 'ListeController');
Route::resource('sprintactivites', 'SprintActiviteController');