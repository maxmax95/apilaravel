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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function(){
    $response = new \Illuminate\Http\Response(json_encode(['msg' => 'first']));
    $response->header('Content-Type','application/json');
    return $response;
    
});

//Products Route
Route::namespace('Api')->prefix('products')->group(function(){

    Route::get('/products','ProductController@index');
    Route::post('/','ProductController@save');

});