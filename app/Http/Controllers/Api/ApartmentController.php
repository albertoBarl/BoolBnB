<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
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


        // Modificare il raggio di default di 20km
        // La presenza obbligatoria di uno o più dei servizi aggiuntivi indicati in RF2

    }
}
