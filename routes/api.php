<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentController as ApartmentController;

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

// searchbar
// Route::get('/geocode/{address}', function ($address) {
//     $client = new \GuzzleHttp\Client(["verify" => false]);
//     $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
//         'query' => [
//             'key' => 'B8Rs31GE9jOKMJ7W5iXNK0LjpI3IO5Rl'
//         ]
//     ]);
//     $result = json_decode($response->getBody(), true);
//     $latitude = $result['results'][0]['position']['latitude'];
//     $longitude = $result['results'][0]['position']['longitude'];
//     return response()->json([
//         'latitude' => $latitude,
//         'longitude' => $longitude
//     ]);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
