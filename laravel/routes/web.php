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




Route::post('/pushTaches', 'TacheController@store');

Route::get('/getTaches', 'TacheController@index');

Route::get('/taches/{id}', 'TacheController@show');
Route::post('/deleteTaches', 'TacheController@destroy');

// 	if (Request::ajax()){
// 		return 'success';
// 	}
// });

// Route::post('/pushTaches', function(){
// 	if (Request::ajax()){
// 		return 'success';
// 	}
// });

Route::get('/acteurs',  array('as'=> 'acteurs', 'uses' => 'acteurs@index'));
Route::post('/sprintactivite/store',  array( 'uses' => 'sprintactivite@store'));
//Route::post('/taches/store',  array( 'uses' => 'taches@store'));

Route::resource('acteurs', 'ActeurController');
Route::resource('taches', 'TacheController');
Route::resource('sprintactivite', 'SprintActiviteController');