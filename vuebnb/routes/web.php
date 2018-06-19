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
Route::get('/', 'ListingController@getHomeWeb');

Route::get('/saved', 'ListingController@getHomeWeb');

Route::get('/listings/{listing}', 'ListingController@getListingWeb');
