<?php

Route::group(['middleware' => ['cors', 'api']], function () {
    Route::post('login', ['uses' => 'LoginController@login']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'categories'], function () {
            Route::get('', ['uses' => 'CategoriesController@all']);
            Route::get('{id}/get', ['uses' => 'CategoriesController@get']);
            Route::post('create', ['uses' => 'CategoriesController@create']);
            Route::put('{id}/update', ['uses' => 'CategoriesController@update']);
            Route::delete('{id}/remove', ['uses' => 'CategoriesController@remove']);
        });
    });
});

