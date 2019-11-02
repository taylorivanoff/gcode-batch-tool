<?php

use Illuminate\Http\Request;

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

Route::get('posts/search', function (Request $request) {
    return App\Post::where('name', 'LIKE', '%' . $request->query('search') . '%')
    	->get();
});

Route::apiResource('posts', 'PostController');
Route::post('posts/file', 'PostController@file');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
