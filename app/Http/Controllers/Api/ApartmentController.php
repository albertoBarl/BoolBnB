<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsors')->paginate(8);
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services', 'sponsors')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'results' => $apartment

            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'nessun appartamento trovato'
            ]);
        }
    }

    // localizator
    public function isLocated($place)
    {
        $apiKey = '98ObIc3GfaoIHmTeR31cHCEP87hLeSmB';
        $tomtomUrl = 'https://api.tomtom.com/search/2/geocode/';
        $searchingFilters = '.json?storeResult=false&language=it-IT&view=Unified&key=';
        $resultUrl = $tomtomUrl . $place . $searchingFilters . $apiKey;

        // disabling ssl certificate
        $client = new \GuzzleHttp\Client([
            "verify" => false
        ]);
        $result = $client->get($resultUrl);
        $response = json_decode($result->getBody(), true);

        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];
        $coordinates = [];
        array_push($coordinates, $lat);
        array_push($coordinates, $lon);

        return $coordinates;
    }

    public function inTheRadius($param1, $radius)
    {
        $apiKey = '98ObIc3GfaoIHmTeR31cHCEP87hLeSmB';
        // retrieve coordinates
        $coordinates = $this->isLocated($param1);
        $apartments = Apartment::all();
        $apUrlString = "";
        $nApartments = count($apartments);
        foreach ($apartments as $key => $apartment) {
            $latitude = "%7D%2C%22position%22%3A%7B%22lat%22%3A";
            $longitude = "%2C%22lon%22%3A";
            if ($key === ($nApartments - 1)) {
                $apartmentPosition = $latitude . $apartment->latitude . $longitude . $apartment->longitude . "%7D%7D";
                $apUrlString = $apartmentPosition;
            } else {
                $comma = "%2C%"; // ...%2C%
                $apartmentPosition = $latitude . $apartment->latitude . $longitude . $apartment->longitude . "%7D%7D" . $comma;
                $apUrlString = $apartmentPosition;
            }
        }

        // generalities
        $endPoRadius = "https://api.tomtom.com/search/2/geometryFilter.json?geometryList=%5B%7B%22type%22%3A%22CIRCLE%22%2C%20%22position%22%3A%22";
        $constEndPo = "%7D%2C%20%7B%22type%22%3A%22POLYGON%22%2C%20%22vertices%22%3A%5B%2237.7524152343544%2C%20-122.43576049804686%22%2C%20%2237.70660472542312%2C%20-122.43301391601562%22%2C%20%2237.712059855877314%2C%20-122.36434936523438%22%2C%20%2237.75350561243041%2C%20-122.37396240234374%22%5D%7D%5D&poiList=%5B";
        // ===============================================================================================================

        // final end point
        $endPoRadiusResults = $endPoRadius . $coordinates[0] . "%2C%20" . $coordinates[1] . "%22%2C%20%22radius%22%3A" . $radius . $constEndPo . $apUrlString . "%5D&key=" . $apiKey;

        // disabling ssl certificate
        $client = new \GuzzleHttp\Client([
            "verify" => false
        ]);
        $result = $client->get($endPoRadiusResults);
        $response = json_decode($result->getBody(), true);

        $filteredList = [];
        foreach ($response["result"] as $location) {
            $latitude = $location['position']['lat'];
            $longitude = $location['position']['lon'];
            // query for filtering by location
            $filter = Apartment::where("latitude", $latitude)->where("longitude", $longitude)->first();

            array_push($filteredList, $filter);
        }
        return $filteredList;
    }

    public function search(Request $search)
    {
        // Numero minimo di stanze
        $rooms = $search->rooms;
        // Numero minimo di posti letto
        $beds = $search->beds;
        // Modificare il raggio di default di 20km
        $range = $search->radius;
        $varRange = '';
        if ($range != null) {
            $varRange = $range * 1000;
        } else {
            $varRange = 20000;
        }
        // La presenza obbligatoria di uno o più dei servizi aggiuntivi indicati in RF2
        $services = $search->services;

        // array for results of search
        $filteredList = [];
    }
}
