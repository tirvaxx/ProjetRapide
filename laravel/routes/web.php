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
/*
Route::get('/', function () {

	return view('projetrapide');
});
*/


Route::get('/{id}',  array('uses' => 'ProjetRapideController@projetInit'));


Route::get('/',  array('uses' => 'ProjetController@index'));
Route::post('/projets', 'ProjetController@store');
Route::get('/projets/{id}/edit', array('projet'=> 'projets', 'uses' => 'ProjetController@edit'));
Route::put('/projets/{id}', 'ProjetController@update');

//Route::get('/taches', 'TacheController@index');
// create ?
Route::post('/taches', 'TacheController@store');
Route::get('/taches/{id}/edit', array('tache'=> 'taches', 'uses' => 'TacheController@edit'));
Route::put('/taches/{id}', 'TacheController@update');
Route::delete('/taches/{id}', 'TacheController@destroy');


Route::post('/sprints', 'SprintController@store');

Route::get('/acteurs',  array('as'=> 'acteurs', 'uses' => 'acteurs@index'));
Route::get('/acteurEmployes',  array('as'=> 'acteurEmployes', 'uses' => 'acteurEmployeController@index'));
Route::get('/acteurEmployes/create',  array('as'=> 'acteurEmployes', 'uses' => 'acteurEmployeController@create'));
Route::post('/acteurEmployes/store',  array('as'=> 'acteurEmployes', 'uses' => 'acteurEmployeController@store'));

Route::get('/listes/{id}/edit', array('liste'=> 'listes', 'uses' => 'ListeController@edit'));
Route::put('/listes/{id}', 'ListeController@update');
Route::post('/listes',  array( 'uses' => 'ListeController@store'));

Route::post('/sprintactivite',  array( 'uses' => 'SprintActiviteController@store'));
//Route::put('/sprintactivite/rendreInactif/{projet_id}/{sprint_id}/{json}', array( 'uses' => 'SprintActiviteController@rendreInactif'));

Route::put('/sprintactivite/rendreInactif', array( 'uses' => 'SprintActiviteController@rendreInactif'));




Route::resource('projets', 'ProjetController');
Route::resource('projetrapide', 'ProjetRapideController');
Route::resource('acteurs', 'ActeurController');
Route::resource('acteurEmployes', 'acteurEmployeController');
Route::resource('taches', 'TacheController');
Route::resource('listes', 'ListeController');
Route::resource('sprintactivites', 'SprintActiviteController');
