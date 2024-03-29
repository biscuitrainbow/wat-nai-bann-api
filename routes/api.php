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

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('login/facebook', 'AuthController@loginWithFacebook');

    Route::post('register', 'AuthController@register');

    Route::get('hashtag', 'TwitterController@fetchBaseHashtag');


    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', 'AuthController@logout');

        Route::get('user', 'UserController@detail');
        Route::put('user', 'UserController@update');

        Route::get('news', 'NewsController@index');
        Route::post('news', 'NewsController@store');
        Route::put('news/{news}', 'NewsController@update');
        Route::delete('news/{news}', 'NewsController@destroy');

        Route::get('activity', 'ActivityController@index');
        Route::post('activity', 'ActivityController@store');
        Route::put('activity/{activity}', 'ActivityController@update');
        Route::delete('activity/{activity}', 'ActivityController@destroy');

        Route::get('survey', 'SurveyController@index');
        Route::post('survey', 'SurveyController@store');
        Route::get('survey/user/{user}', 'SurveyController@userSurvey');

    });
});



