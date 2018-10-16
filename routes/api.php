<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::post('addCustomer/{name}/{cnp}', 'ApiController@addCustomer');
    Route::get('getTransaction/{customerId}/{transactionId}', 'ApiController@getTransaction');
    Route::get('getTransactionByFilters/{customerId}/{amount}/{date}/{offset}/{limit}', 'ApiController@getTransactionByFilters');
    Route::post('addTransaction/{customerId}/{amount}', 'ApiController@addTransaction');
    Route::post('updateTransaction/{transactionId}/{amount}', 'ApiController@updateTransaction');
    Route::post('deleteTransaction/{transactionId}', 'ApiController@deleteTransaction');
    Route::get('getTransactions', 'ApiController@getTransactions');
});