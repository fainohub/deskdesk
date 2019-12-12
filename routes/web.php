<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'agents', 'namespace' => 'Agent'], function (){
    Route::group(['prefix' => 'login'], function (){
        Route::get('/', 'LoginController@index')->name('agent.login.index');
        Route::post('/', 'LoginController@login')->name('agent.login.post');
    });
});

Route::group(['prefix' => 'customers', 'namespace' => 'Customer'], function (){
    Route::group(['prefix' => 'register'], function (){
        Route::get('/', 'RegisterController@index')->name('customer.register.index');
        Route::post('/', 'RegisterController@save')->name('customer.register.save');
    });

    Route::group(['prefix' => 'login'], function (){
        Route::get('/', 'LoginController@index')->name('customer.login.index');
        Route::post('/', 'LoginController@login')->name('customer.login.post');
    });
});
