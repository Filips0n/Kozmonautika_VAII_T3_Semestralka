<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RocketController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SpaceportController;
use App\Http\Controllers\ManufacturerController;


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

Route::view('/', 'home')->name("homePage");
Route::view('/vesmirne-agentury', 'vesmirne-agentury')->name("vesmirneAgenturyPage");
Route::view('/vysvetlivky', 'vysvetlivky')->name("vysvetlivkyPage");

Route::get('/krajiny', [CountryController::class, 'index'])->name("krajinyPage");
Route::get('/fetch_data', [CountryController::class, 'fetch_data'])->name('fetchCountry');
Route::post('/destroyCountry', [CountryController::class, 'destroy'])->name('deleteCountry');
Route::post('/updateCountry', [CountryController::class, 'update'])->name('updateCountry');
Route::post('/storeCountry', [CountryController::class, 'store'])->name('createCountry');

Route::get('/vyrobcovia', [ManufacturerController::class, 'index'])->name("vyrobcoviaPage");
Route::get('/destroyManufacturer/{id}', [ManufacturerController::class, 'destroy']);
Route::post('/updateManufacturer/{manufacturer}', [ManufacturerController::class, 'update'])->name('updateManufacturer');
Route::post('/storeManufacturer', [ManufacturerController::class, 'store'])->name('createManufacturer');

Route::get('/kozmodromy', [SpaceportController::class, 'index'])->name("kozmodromyPage");
Route::get('/destroySpaceport/{id}', [SpaceportController::class, 'destroy']);
Route::post('/updateSpaceport/{spaceport}', [SpaceportController::class, 'update'])->name('updateSpaceport');
Route::post('/storeSpaceport', [SpaceportController::class, 'store'])->name('createSpaceport');

Route::get('/rakety', [RocketController::class, 'index'])->name("raketyPage");
Route::get('/destroy/{id}', [RocketController::class, 'destroy']);
Route::post('/update/{rocket}', [RocketController::class, 'update'])->name('updateRocket');
Route::post('/store', [RocketController::class, 'store'])->name('createRocket');
require __DIR__.'/auth.php';