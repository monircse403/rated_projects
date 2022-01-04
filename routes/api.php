<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/v1')->group( function() {
    Route::get('customers', 'Customer\CustomersController@index');
    Route::get('customers/{id}', 'Customer\CustomersController@show');
    Route::post('customers', 'Customer\CustomersController@store');
    Route::put('customers/{id}', 'Customer\CustomersController@update');
    Route::delete('customers/{id}', 'Customer\CustomersController@destroy');


    Route::get('incomes', 'Income\IncomesController@index');
    Route::get('incomes/{id}', 'Income\IncomesController@show');
    Route::post('incomes', 'Income\IncomesController@store');
    Route::put('incomes/{id}', 'Income\IncomesController@update');
    Route::delete('incomes/{id}', 'Income\IncomesController@destroy');
});

