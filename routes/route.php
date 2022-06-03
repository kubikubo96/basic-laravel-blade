<?php

use Illuminate\Support\Facades\Route;

//route webhook endpoint casso
Route::group(['prefix' => 'webhook'], function () {
    Route::post('/payment-handler', 'Casso\EndpointWebhookCasso@paymentHandler')->name('payment');

});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/store-role', 'AuthController@storeRole');
    Route::post('/store-permission', 'AuthController@storePermission');
    Route::post('/assign-permission-to-role', 'AuthController@assignPermissionToRole');
    Route::post('/assign-user-to-role', 'AuthController@assignUserToRole');
    Route::get('/check-permission', 'AuthController@checkPermission');
    Route::get('/view-post', 'AuthController@viewPost');
});

Route::group(['middleware' => ['role:author']], function () {
    Route::post('/update-post', 'AuthController@updatePost');
});
