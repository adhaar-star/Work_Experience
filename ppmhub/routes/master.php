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

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'master', 'namespace' => 'Admin\Master'], function () {

        Route::get('customer-data-table', 'CustomersController@data_table')->name('customer-data-table');
        Route::resource('customer', 'CustomersController');

        Route::get('material-data-table', 'MaterialsController@data_table')->name('material-data-table');
        Route::resource('material', 'MaterialsController');

        Route::get('material-category-data-table', 'MaterialCategoriesController@data_table')->name('material-category-data-table');
        Route::resource('material-category', 'MaterialCategoriesController');

        Route::get('material-group-data-table', 'MaterialGroupsController@data_table')->name('material-group-data-table');
        Route::resource('material-group', 'MaterialGroupsController');

        Route::get('order-unit-data-table', 'OrderUnitsController@data_table')->name('order-unit-data-table');
        Route::resource('order-unit', 'OrderUnitsController');

        Route::get('unit-of-measure-data-table', 'UnitOfMeasureController@data_table')->name('unit-of-measure-data-table');
        Route::resource('unit-of-measure', 'UnitOfMeasureController');

        Route::get('vendor-data-table', 'VendorsController@data_table')->name('vendor-data-table');
        Route::resource('vendor', 'VendorsController');

        Route::get('range-numbers-data-table', 'RangesController@data_table')->name('range-numbers-data-table');
        Route::resource('range-numbers', 'RangesController');

    });

});
