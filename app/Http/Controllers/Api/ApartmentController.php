<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    public function index(){
        $apartments = Apartment::with('services', 'sponsors')->paginate(8);
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }
}
