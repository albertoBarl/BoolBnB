<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Apartment;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Apartment::all();
        return view('admin.messages.index', compact('messages'));
    }
}
