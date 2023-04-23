<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CarmodelController;

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

Route::redirect('/', 'country');
Route::resource('country', CountryController::class);

Route::resource('manufacturer', ManufacturerController::class, ['except' => ['index', 'create']]);
Route::get('{countryslug}/manufacturer', [ManufacturerController::class, 'index']);
Route::get('{countryslug}/manufacturer/create', [ManufacturerController::class, 'create']);

Route::resource('carmodel', CarmodelController::class, ['except' => ['index', 'create']]);
Route::get('manufacturer/{manufacturerslug}/models', [CarmodelController::class, 'index']);
Route::get('{manufacturerslug}/carmodel/create', [CarmodelController::class, 'create']);