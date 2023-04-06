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
    }

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
}
