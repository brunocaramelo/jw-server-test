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

Route::middleware('jwt.auth')->post('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => 'jwt.auth' ],function( ){
   
    Route::group(['prefix' => 'user'], function( ){

        Route::post('current',function ( Request $request ) {
            return $request->user();
        });
        
        Route::group(['prefix' => 'admin'], function(){
            Route::get('/', 'Users\UsersController@index');
            Route::get('edit/{id}', 'Users\UsersController@edit');
            Route::post('edit', 'Users\UsersController@update');
            Route::post('new', 'Users\UsersController@insert');
            Route::post('remove', 'Users\UsersController@exclude');
        });

        // Route::resource('posts','ApiControllers\PostsApiController');
    });
    
});

