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

Route::get('/', 'HomeController@index')->name('home.index');

Route::group(['prefix' => 'agent', 'namespace' => 'Agent'], function (){
    Route::get('login', 'LoginController@index')->name('agent.login');
    Route::post('login', 'LoginController@login')->name('agent.login.post');

    Route::get('logout', 'LoginController@logout')->name('agent.logout');

    Route::group(['prefix' => 'dashboard'], function (){
        Route::get('/', 'DashboardController@index')->name('agent.dashboard.index');
    });
});

Route::group(['prefix' => 'customer', 'namespace' => 'Customer'], function (){
    Route::get('register', 'RegisterController@index')->name('customer.register');
    Route::post('register', 'RegisterController@store')->name('customer.register.store');

    Route::get('login', 'LoginController@index')->name('customer.login');
    Route::post('login', 'LoginController@login')->name('customer.login.post');

    Route::get('logout', 'LoginController@logout')->name('customer.logout');

    Route::group(['prefix' => 'tickets'], function (){
        Route::get('/', 'TicketController@index')->name('customer.tickets.index');
        Route::get('/create', 'TicketController@create')->name('customer.tickets.create');
        Route::post('/', 'TicketController@store')->name('customer.tickets.store');
    });
});
