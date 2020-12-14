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

Route::get('/',"User\HomeController@index");
Route::get('/detail/{id}',"User\HomeController@detail");

Route::group(["middleware" => "isNotSudo"],function(){
	Route::get('/sudo',"Sudo\AuthController@signin");	
	Route::post('/sudo/signin','Sudo\AuthController@actionSignin');
});

Route::group(["middleware" => "isSudo"],function(){
	Route::get('/sudo/user','Sudo\UserController@index');
	Route::get('/sudo/user/delete/{id}','Sudo\UserController@delete');
	Route::post("/sudo/user/add","Sudo\UserController@add");
	Route::post('/sudo/user/edit','Sudo\UserController@edit');

	Route::get('/sudo/articel','Sudo\ArticelController@index');
	Route::get('/sudo/articel/delete/{id}','Sudo\ArticelController@delete');
	Route::post("/sudo/articel/add","Sudo\ArticelController@add");
	Route::post("/sudo/articel/edit",'Sudo\ArticelController@edit');
	
	Route::get('/sudo/home','Sudo\HomeController@index');
	Route::get('/sudo/logout','Sudo\AuthController@logout');
});