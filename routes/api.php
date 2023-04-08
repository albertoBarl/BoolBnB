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

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
Route::get("/apartments/search/", [ApartmentController::class, "search"]);

// services
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/sponsorship', [ApartmentController::class, 'sponsorship']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
