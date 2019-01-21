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
    '/home/truncate',
    'HomeController@truncateTable'
)->name('home.truncate');

Route::resource('days', 'DayController');

Route::delete(
    '/days/truncate',
    'DayController@truncateTable'
)->name('days.truncate');

Route::resource('shifts', 'ShiftController');

Route::delete(
    '/shifts/truncate',
    'ShiftController@truncateTable'
)->name('shifts.truncate');

Route::resource('workers', 'WorkerController');

Route::delete(
    '/workers/truncate',
    'WorkerController@truncateTable'
)->name('workers.truncate');

Route::resource('matchings', 'MatchingController');

Route::delete(
    '/matchings/truncate',
    'MatchingController@truncateTable'
)->name('matchings.truncate');
