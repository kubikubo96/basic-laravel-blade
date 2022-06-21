<?php

use Illuminate\Support\Facades\Route;

/**
 * Webhook endpoint casso
 */
Route::group(['prefix' => 'webhook'], function () {
    Route::post('/payment-handler', 'Casso\EndpointWebhookCasso@paymentHandler')->name('payment');

});

/**
 * crawler
 */
Route::get('/crawler/all', 'API\APIController@all');
Route::post('/crawler/store', 'API\APIController@store');
Route::post('/crawler/convert', 'API\APIController@convert');
Route::post('/crawler/update', 'API\APIController@update');

/**
 * Example send event to client listen
 */
Route::get('/broadcast', function () {
    broadcast(new \App\Events\Hello());
});
