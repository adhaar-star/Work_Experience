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

    Route::group(['prefix' => 'billing', 'namespace' => 'Admin\Billing'], function () {

        Route::get('/',   'BillingController@index')->name('billing-list');
        Route::get('create', 'BillingController@create')->name('billing-create');
        Route::post('save',  'BillingController@store')->name('billing-save');

        Route::get('{billing}/view', 'BillingController@view')->name('billing-single-view');
        Route::get('{billing}/pdf', 'BillingController@view_pdf')->name('billing-single-view-pdf');
    });


});
