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



Route::get('/old', function () {
    return view('projetRapideOld');
});

Route::get('/acteurs',  array('as'=> 'acteurs', 'uses' => 'acteurs@test'));
Route::resource('acteurs', 'ActeurController');