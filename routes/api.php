<?php

use App\Http\Controllers\CityController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('cities', [CityController::class, 'index'])->middleware(EnsureTokenIsValid::class)->name('api.cities.index');
Route::get('cities/{city}/forecast/{days?}', [CityController::class, 'forecastByCity'])->middleware(EnsureTokenIsValid::class)->name('api.city.forecast');