<?php

Route::settings('ga4', function () {
    Route::group(['as' => 'setting.'], function () {
        Route::get('setting', ['as' => 'edit', 'uses' => 'ManageController@edit']);
        Route::post('setting', ['as' => 'update', 'uses' => 'ManageController@update']);
    });
});

//Route::fixed('ga4', function () {
//    Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'settings'], function () {
//        Route::get('visit', ['as' => 'visit', 'uses' => 'ApiController@visit']);
//        Route::get('term', ['as' => 'term', 'uses' => 'ApiController@term']);
//        Route::get('browser', ['as' => 'browser', 'uses' => 'ApiController@browser']);
//        Route::get('source', ['as' => 'source', 'uses' => 'ApiController@source']);
//        Route::get('pv', ['as' => 'pv', 'uses' => 'ApiController@pv']);
//        Route::get('device', ['as' => 'device', 'uses' => 'ApiController@device']);
//        Route::get('page', ['as' => 'page', 'uses' => 'ApiController@page']);
//    });
//
//    Route::get('test', 'ApiController@test');
//});
