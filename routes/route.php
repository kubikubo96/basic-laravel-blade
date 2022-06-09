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
Route::post('/crawler', 'API\APIController@index');

/**
 * Example send event to client listen
 */
Route::get('/broadcast', function () {
    broadcast(new \App\Events\Hello());
});
