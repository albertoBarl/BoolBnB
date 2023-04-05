<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();
        return response()->json([
            'success' => true,
            'results' => $services
        ]);
    }
}
