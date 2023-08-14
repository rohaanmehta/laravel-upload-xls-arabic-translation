<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post('checkin_request', 'Portal@checkin');
// Route::post('checkout_request', 'Portal@checkout');
Route::get('/', 'Admin@login');
Route::get('dashboard', 'Dashboard@view');
// Route::post('report_data', 'Report@report_data');
Route::post('logincheck', 'Admin@logincheck');
Route::post('logout', 'Admin@logout');
Route::post('excel', 'Admin@excel');
// Route::get('thankyou', 'Admin@thankyou');

// Route::get('email', 'Email@mail');