<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use App\Http\Controllers\Api\ApartmentController as ApartmentController;
use App\Http\Controllers\Api\ServiceController as ServiceController;

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
// services
Route::get('/services', [ServiceController::class, 'index']);

// apartments in evidence
Route::get('/sponsorship', [ApartmentController::class, 'sponsorship']);

// apartments trough location filter
Route::get('/apartments', [ApartmentController::class, 'index']);
// single apartment details
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
// filter by range, rooms exc.
Route::get("/apartments/search/{model}", [ApartmentController::class, "search"]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
