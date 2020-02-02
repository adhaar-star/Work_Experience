<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes | Time Sheet
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::model('activity-rates', \App\Models\Setting\ActivityRate::class);

Route::group(['prefix' => 'admin'], function () {

        Route::group(['prefix' => 'setting', 'namespace' => 'Admin\Setting'], function () {

            Route::resource('activity-rates', 'ActivityRatesController');
            Route::get('activity-rates-data-table', 'ActivityRatesController@data_table')->name('activity-rates-data-table');

            Route::resource('activity-type',  'ActivityTypesController');

        });

});
