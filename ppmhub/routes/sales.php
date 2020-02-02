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

        Route::group(['prefix' => 'sales', 'namespace' => 'Admin\Sales'], function () {
            Route::get('get-project-task-phase', 'OrdersController@get_project_task_phase')->name('get-project-task-phase');
            Route::get('get-material-by-id', 'OrdersController@get_material')->name('get-material-by-id');

            Route::get('orders', 'OrdersController@index')->name('sales-order-index');

            Route::get('order-create', 'OrdersController@create')->name('sales-order-create');
            Route::post('order-save', 'OrdersController@store')->name('sales-order-save');
            Route::post('/{order}/order-update', 'OrdersController@update')->name('sales-order-update');
            Route::get('/{order}/edit', 'OrdersController@edit')->name('sales-order-edit');
            Route::post('/{order}/order-submit', 'OrdersController@order_submit')->name('sales-order-submit');
            Route::post('/{order}/order-approve', 'OrdersController@order_approve')->name('sales-order-approve');
            Route::post('/{order}/order-reject', 'OrdersController@order_reject')->name('sales-order-reject');

            Route::get('/get-order-items-billing', 'OrdersController@get_order_items_billing')->name('get-sales-order-items-billing');

            Route::get('/{order}/order-items', 'OrdersController@order_items')->name('sales-order-items');
            Route::post('/{order}/sales-order-save-items', 'OrdersController@save_order_items')->name('sales-order-save-items');
            Route::post('/{orderItem}/order-items-delete', 'OrdersController@order_items_delete')->name('sales-order-items-delete');
            Route::post('/{orderItem}/order-items-delivery', 'OrdersController@order_items_delivery')->name('sales-order-items-delivery');

        });


    Route::group(['prefix' => 'inquiry', 'namespace' => 'Admin\Sales'], function () {

        Route::get('/', 'SalesInquiriesController@index' )->name('sales-order-inquiry-index');
        Route::get('create', 'SalesInquiriesController@create')->name('sales-order-inquiry-create');
        Route::post('save', 'SalesInquiriesController@store')->name('sales-order-inquiry-save');
        Route::get('/{inquiry}/edit', 'SalesInquiriesController@edit')->name('sales-order-inquiry-edit');
        Route::post('/{inquiry}/update', 'SalesInquiriesController@update')->name('sales-order-inquiry-update');

        Route::get('/{inquiry}/items', 'SalesInquiriesController@inquiry_items')->name('sales-order-inquiry-items');
        Route::post('/{inquiry}/save-item', 'SalesInquiriesController@save_items')->name('sales-order-inquiry-save-item');
        Route::post('/{inquiryItem}/items-delete', 'SalesInquiriesController@order_items_delete')->name('sales-order-inquiry-items-delete');

        Route::post('/{inquiry}/quotation-create-form-inquiry', 'SalesInquiriesController@create_quotation_form_inquiry')->name('sales-order-quotation-create-form-inquiry');

    });

    Route::group(['prefix' => 'quotation', 'namespace' => 'Admin\Sales'], function () {

        Route::get('/', 'SalesQuotationsController@index' )->name('sales-order-quotation-index');
        Route::get('create', 'SalesQuotationsController@create')->name('sales-order-quotation-create');
        Route::post('save', 'SalesQuotationsController@store')->name('sales-order-quotation-save');
        Route::get('/{quotation}/edit', 'SalesQuotationsController@edit')->name('sales-order-quotation-edit');
        Route::post('/{quotation}/update', 'SalesQuotationsController@update')->name('sales-order-quotation-update');

        Route::get('/{quotation}/items', 'SalesQuotationsController@inquiry_items')->name('sales-order-quotation-items');
        Route::post('/{quotation}/save-item', 'SalesQuotationsController@save_items')->name('sales-order-quotation-save-item');
        Route::post('/{quotationItem}/items-delete', 'SalesQuotationsController@order_items_delete')->name('sales-order-quotation-items-delete');

        Route::post('/{quotation}/submit', 'SalesQuotationsController@submit')->name('sales-order-quotation-submit');

        Route::post('/{quotation}/approve', 'SalesQuotationsController@approve')->name('sales-order-quotation-approve');
        Route::post('/{quotation}/approve-customer', 'SalesQuotationsController@approve_customer')->name('sales-order-quotation-approve-customer');
        Route::post('/{quotation}/reject', 'SalesQuotationsController@reject')->name('sales-order-quotation-reject');

        Route::post('/{quotation}/create-sales-order', 'SalesQuotationsController@create_sales_order')->name('sales-order-quotation-create-order');
    });


});
