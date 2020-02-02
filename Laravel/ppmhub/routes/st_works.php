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
        Route::group(['prefix' => 'timesheet-work', 'namespace' => 'Admin\TimeSheet'], function () {

            // TODO: Cost Should move to Any Project Controller
            Route::get('costs', 'TimeSheetWorkController@costs')->name('timesheet.cost.dashboard');

            Route::get('list', 'TimeSheetWorkController@index')->name('timesheet.work.list.dashboard');
            Route::get('entry-form', 'TimeSheetWorkController@entry_form')->name('timesheet.work.create');
            Route::post('save', 'TimeSheetWorkController@timesheet_work_save')->name('timesheet.work.save');

            Route::post('copy-week', 'TimeSheetWorkController@timesheet_work_copy_week')->name('timesheet-work-copy-week');

            Route::get( 'approvals-list',  'TimeSheetWorkController@approvals_list' )->name('timesheet.work.approvals.list');
            Route::get( '{id}/make-approved',  'TimeSheetWorkController@make_approved'  )->name('timesheet-work-make-approved');
            Route::get( '{id}/make-rejected',  'TimeSheetWorkController@make_rejected'  )->name('timesheet-work-make-rejected');

        });
});
