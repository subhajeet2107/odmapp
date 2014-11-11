<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/','UserController@index');
Route::get('/index','UserController@index');
Route::post('/index/signin','UserController@signin');
Route::get('/logout','UserController@logout');
Route::get('/dashboard','DashboardController@getIndex');
Route::get('/dashboard/','DashboardController@getIndex');
Route::controller('dashboard','DashboardController');
Route::controller('sheets','SheetsController');
Route::controller('products','ProductsController');
Route::controller('exporter','ExporterController');
Route::controller('allproducts','AllProductsController');
App::missing(function($exception)
{
		return Response::view('error', array(), 404);
});

