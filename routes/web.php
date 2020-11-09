<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as Route;

Route::get('/', 'PageController@index');

Auth::routes();

Route::get('/calendar', 'HomeController@index')->name('calendar');
Route::get('/calendar/{year}-{month}', 'HomeController@month')->name('calendar.month');
Route::resource('entries', 'EntryController');
Route::middleware('auth')->get('/browse', 'EntryController@browse')->name('browse');

Route::patch(
    '/user-preferences', 'UserPreferencesController@update'
)->name('userPreferences.update');
