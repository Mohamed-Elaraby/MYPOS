<?php

Route::prefix('dashboard')->name('dashboard.')->namespace('Dashboard')->middleware(['auth'])->group(function (){


    /* Dashboard Routs*/

    Route::get('index', 'DashboardController@index')->name('index');
    /* User Routs*/
    Route::resource('user', 'UserController')->except('show');

    /* Category Routs*/
    Route::resource('category', 'CategoryController');

    /* downloadImage Routs*/
    Route::get('downloadImage', 'UserController@downloadImage')->name('downloadImage');


});
