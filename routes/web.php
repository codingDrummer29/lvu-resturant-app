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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// category routes starts

// Route::get('/category/create', 'CategoryController@create');
// Route::resource('category', 'CategoryController');
Route::resource('category', 'CategoryController')->middleware('auth');

// category routes ends

// food routes starts

// Route::resource('food', 'FoodController');
Route::resource('food', 'FoodController')->middleware('auth');

// food routes ends

// landing page
Route::get('/', 'FoodController@listFood');
// food-item view page
Route::get('/foods/{id}', 'FoodController@view')->name('food.view');
