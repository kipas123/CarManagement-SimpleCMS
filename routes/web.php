<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Login', [
        'canLogin' => Route::has('login'),
         'canRegister' => Route::has('register'),
    ]);
});

// Registration Routes...
// $this->get('register', 'Auth\AuthController@showRegistrationForm');
// $this->post('register', 'Auth\AuthController@register');

Route::get('/logout', '\App\Http\Controllers\LoginCtrl@logout');
Route::get('/carManagement', 'App\Http\Controllers\CarManagementCtrl@show')->middleware('auth');;

//carList
Route::get('/carManagement', 'App\Http\Controllers\CarManagementCtrl@show')->name('carManagement')->middleware('auth');;
Route::get('/carManagement/{page}', 'App\Http\Controllers\CarManagementCtrl@show')->middleware('auth');;

//addCar
Route::get('/addCar', 'App\Http\Controllers\CarManagementCtrl@addCarView')->middleware('auth');;
Route::post('/addCar', 'App\Http\Controllers\CarManagementCtrl@addCar')->middleware('auth');;

Route::get('/carPreview/{id}', 'App\Http\Controllers\CarManagementCtrl@carPreview')->middleware('auth');;

//edit car
Route::get('/editCar/{id}', 'App\Http\Controllers\CarManagementCtrl@editCarView')->middleware('auth');;
Route::post('/editCar/{id}', 'App\Http\Controllers\CarManagementCtrl@editCar')->middleware('auth');;

//delete car
Route::get('/deleteCar/{id}', 'App\Http\Controllers\CarManagementCtrl@deleteCar')->middleware('auth');;


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
