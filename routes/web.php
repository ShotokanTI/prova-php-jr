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

Route::get('/','contratoController@index')->name('/');

Auth::routes();

//alteracoes gitdsfvadfa
//dfsafdfs
//Route::get('/homeAjax', 'srfwfrewfrcontratoTela@index')->name('homeAjax');
// //Auth::routes();

//Route::get('/contratoTela', 'contratoController@index')->name('contratoTela');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::get('home', 'contratoController@index')->name('home');
Route::get('roles','contratoController@exibirRole')->name('roles');

Route::post('addRole','contratoController@addRole')->name('addRole');

Route::post('homeAjax/exibirDelete','contratoController@exibirDelete')->name('homeAjax/exibirDelete');

Route::get('backEstados','contratoController@backEstados')->name('backEstados');
Route::get('backCidades/{id}','contratoController@backCidadesByEstado')->name('backCidades');

Route::post('homeAjax/updateTable','contratoController@updateTable')->name('homeAjax/updateTable');
Route::post('homeAjax/updateRoles','contratoController@updateRoles')->name('homeAjax/updateRoles');
Route::resource('homeAjax', 'contratoController');

Route::get('search','contratoController@search')->name('search');