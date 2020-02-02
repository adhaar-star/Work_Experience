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

Route::model('milestone', \App\Models\Projects\ProjectMilestone::class);
Route::group(['prefix' => 'admin'], function () {

        Route::group(['prefix' => 'projects', 'namespace' => 'Admin\Project'], function () {

            Route::get('milestone-data-table', 'MilestonesController@data_table')->name('milestone-data-table');
            Route::resource('milestone', 'MilestonesController');

        });
});
