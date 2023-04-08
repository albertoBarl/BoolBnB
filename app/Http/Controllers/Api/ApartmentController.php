<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $street = $request->street;
        $radius = 20000;
        $arrayIdAps = [];
        $apCoordinates = $this->isLocated($street);
        $apOnLocation = $this->theRadius($street, $radius);
        $cooLat = $apCoordinates["latitude"];
        $cooLon = $apCoordinates["longitude"];
        foreach ($apOnLocation as $apartment) {
            array_push($arrayIdAps, $apartment->id);
        }

        $apId = Apartment::whereIn('id', $arrayIdAps)
            ->select(['*'])
            ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$cooLat, $cooLon, $cooLat])
            ->havingRaw("distance < ?", [$radius])
            ->with('services')
            ->get();

        return response()->json([
            'success' => true,
            'indexResults' => $apId
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services', 'sponsors')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'showResults' => $apartment

            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'nessun appartamento trovato'
            ]);
        }
    }

    public function sponsorship()
    {
        $sponsorship = Apartment::Has('sponsors')->get();
        return response()->json([
            'success' => true,
            'sponsorshipResults' => $sponsorship
        ]);
    }

    public function isLocated($request)
    {

        $apiKey = "B8Rs31GE9jOKMJ7W5iXNK0LjpI3IO5Rl";
        $firstHalf = "https://api.tomtom.com/search/2/geocode/";
        $client = new \GuzzleHttp\Client([
            "verify" => false
        ]);
        $response = $client->get($firstHalf . urlencode($request) . '.json', [
            'query' => [
                'key' => $apiKey,
                'language' => 'it-IT'
            ]
        ]);
        $result = json_decode($response->getBody(), true);

        $coordinates = [
            "latitude" => $result['results'][0]['position']['lat'],
            "longitude" => $result['results'][0]['position']['lon'],
        ];

        return  $coordinates;
    }

    public function theRadius($request, $radius)
    {
        $coordinates = $this->isLocated($request);
        $apiKey = 'B8Rs31GE9jOKMJ7W5iXNK0LjpI3IO5Rl';
        $radiusUrl = "https://api.tomtom.com/search/2/geometryFilter";

        $apartments = Apartment::all();
        $client = new \GuzzleHttp\Client([
            "verify" => false
        ]);
        $geometryList = [
            [
                "type" => "CIRCLE",
                "position" => "{$coordinates["latitude"]}, {$coordinates["longitude"]}",
                "radius" => $radius
            ]
        ];
        $poiList = [];
        foreach ($apartments as $key => $apartment) {
            $poiList[] = [
                "poi" => [
                    "name" => $apartment->title
                ],
                "address" => [
                    "freeformAddress" => $apartment->address
                ],
                "position" => [
                    "lat" => $apartment->latitude,
                    "lon" => $apartment->longitude
                ]
            ];
        }
        $response = $client->get($radiusUrl . '.json', [
            'query' => [
                'key' => $apiKey,
                'language' => 'it-IT',
                'geometryList' => json_encode($geometryList),
                'poiList' => json_encode($poiList)
            ]
        ]);
        $result = json_decode($response->getBody(), true);

        $filteredList = [];
        foreach ($result["results"] as $location) {
            $latitude = $location['position']['lat'];
            $longitude = $location['position']['lon'];
            // query for filtering by location
            $filter = Apartment::where("latitude", $latitude)->where("longitude", $longitude)->first();

            array_push($filteredList, $filter);
        }
        return $filteredList;
    }

    public function searchBy(Request $request)
    {
        $street = $request->street;
        $radius = $request->radius;
        $varRadius = "";
        if ($radius != null) {
            $varRadius = $radius * 1000;
        } else {
            $varRadius = 20000;
        };

        $arrayIdAps = [];
        $apsNearFinded = $this->theRadius($street, $radius);
        $coordinates = $this->isLocated($street);
        foreach ($apsNearFinded as $apartment) {
            array_push($arrayIdAps, $apartment->id);
        }
        // if ($services === []) {
        //     # code...
        // } else {
        //     # code...
        // }

    }
    // // searching
    // public function search(Request $search)
    // {
    //     // // Numero minimo di stanze
    //     // $rooms = $search->rooms;
    //     // // Numero minimo di posti letto
    //     // $beds = $search->beds;
    //     // // Modificare il raggio di default di 20km
    //     // $position = $search->street;
    //     // $range = $search->radius;
    //     // $varRange = '';
    //     // if ($range != null) {
    //     //     $varRange = $range * 1000;
    //     // } else {
    //     //     $varRange = 20000;
    //     // }
    //     // // La presenza obbligatoria di uno o più dei servizi aggiuntivi indicati in RF2
    //     // $services = $search->services;

    //     // // array for results of search
    //     // $filteredList = [];
    //     // $apOnLocation = $this->inTheRadius($position, $varRange);
    //     // $apCoordinates = $this->isLocated($position);
    //     // foreach ($apOnLocation as $apartment) {
    //     //     array_push($filteredList, $apartment->id);
    //     // }
    //     // if ($services === []) {
    //     //     $apId = Apartment::whereIn('id', $filteredList)->where('rooms', '>=', $rooms)->where('beds', '>=', $beds)->select(['*'])->selectRaw('(6371 * acos(cos(radians($apCoordinates[0])) * cos(radians(latitude)) * cos(radians(longitude) - radians($apCoordinates[1])) + sin(radians($apCoordinates[0])) * sin(radians(latitude)))) AS distance")->havingRaw("distance < $range")->get();
    //     //     return response()->json([
    //     //         'success' => true,
    //     //         'searchResults' => $apId
    //     //     ]);
    //     // } else {
    //     //     $apId = Apartment::whereIn('id', $filteredList)->whereHas('services', function ($query) use ($services) {
    //     //         $query->whereIn('services.id', $services);
    //     //     })
    //     //         ->withCount(['services' => function ($query) use ($services) {
    //     //             $query->whereIn('services.id', $services);
    //     //         }])
    //     //         ->where('rooms', '>=', $rooms)->where('beds', '>=', $beds)->select(['*'])->selectRaw("(6371 * acos(cos(radians($apCoordinates[0])) * cos(radians(latitude)) * cos(radians(longitude) - radians($apCoordinates[1])) + sin(radians($apCoordinates[0])) * sin(radians(latitude)))) AS distance")->havingRaw("distance < $range")->get();
    //     //     return response()->json([
    //     //         'success' => true,
    //     //         'searchResults' => $apId
    //     //     ]);
    //     // }
    // }
}
