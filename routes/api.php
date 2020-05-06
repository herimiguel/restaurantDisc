<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('/api/restaurants', 'RestaurantsController');
// Route::resource('/profiles', 'RestaurantsController@profiles');

Route::put('/api/restaurants/', 'RestaurantsController');
Route::put('/api/restaurants/', 'RestaurantsController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
