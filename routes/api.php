<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
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
Route::get("/apartments/search", [ApartmentController::class, "search"]);

// services
Route::get('/services', [ServiceController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/geocode/{address}', function ($address) {
//     $client = new \GuzzleHttp\Client(["verify" => false]);
//     $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
//         'query' => [
//             'key' => 'B8Rs31GE9jOKMJ7W5iXNK0LjpI3IO5Rl'
//         ]
//     ]);
//     $result = json_decode($response->getBody(), true);
//     $latitude = $result['results'][0]['position']['lat'];
//     $longitude = $result['results'][0]['position']['lon'];
//     return response()->json([
//         'latitude' => $latitude,
//         'longitude' => $longitude
//     ]);
// });
