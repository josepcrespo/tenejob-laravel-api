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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::delete(
    '/home/delete/all',
    'HomeController@resetTable'
)->name('home.delete.all');

Route::resource('days', 'DayController');

Route::delete(
    '/days/delete/all',
    'DayController@resetTable'
)->name('days.delete.all');

Route::resource('shifts', 'ShiftController');

Route::delete(
    '/shifts/delete/all',
    'ShiftController@resetTable'
)->name('shifts.delete.all');

Route::resource('workers', 'WorkerController');

Route::delete(
    '/workers/delete/all',
    'WorkerController@resetTable'
)->name('workers.delete.all');

Route::resource('matchings', 'MatchingController');

Route::delete(
    '/matchings/delete/all',
    'MatchingController@resetTable'
)->name('matchings.delete.all');
