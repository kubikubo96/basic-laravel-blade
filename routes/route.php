<?php

use Illuminate\Support\Facades\Route;

//route webhook endpoint casso
Route::group(['prefix' => 'webhook'], function () {
    Route::post('/payment-handler', 'Casso\EndpointWebhookCasso@paymentHandler')->name('payment');

});

Route::post('/crawler', 'API\APIController@index');
