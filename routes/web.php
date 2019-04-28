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
    return view('welcome');
});

Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search', 'SearchController@query')->name('search');
Route::get('/search/watch={id}', 'SearchController@viewSearch')->name('search');


Route::get('/favorites', 'FavoritesController@index')->name('favorites');
Route::get('/favorites', 'FavoritesController@userFav')->name('favorites');
Route::post('/favorites', 'FavoritesController@isFav')->name('favorites');
Route::get('/favorites/watch={id}', 'FavoritesController@viewFav')->name('favorites');

Auth::routes();
