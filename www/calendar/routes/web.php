<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'CalendarEventsController@index')->name('home');


        Route::get('/company', 'CompanyController@index')->name('company.index');
    Route::group(['prefix' => '/company', 'as' => 'company.'], function () {
        Route::get('/create', 'CompanyController@create')->name('create');
        Route::post('/store', 'CompanyController@store')->name('store');
        Route::get('/{company}/edit', 'CompanyController@edit')->name('edit');
        Route::put('/{company}/update', 'CompanyController@update')->name('update');
        Route::delete('/{company}/delete', 'CompanyController@delete')->name('delete');
    });

        Route::get('/calendar', 'CalendarEventsController@index')->name('calendar.index');
    Route::group(['prefix' => '/calendar', 'as' => 'calendar.'], function () {
        Route::get('/create', 'CalendarEventsController@create')->name('create');
        Route::post('/store', 'CalendarEventsController@store')->name('store');
        Route::get('/{event}/edit/{company_id}', 'CalendarEventsController@edit')->name('edit');
        Route::put('/{event}/update', 'CalendarEventsController@update')->name('update');
        Route::delete('/{event}/delete', 'CalendarEventsController@delete')->name('delete');
    });

});
