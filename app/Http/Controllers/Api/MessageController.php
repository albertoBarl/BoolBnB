<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        $form_data = $request->validated();

        $slug = Message::generateSlug($request->email);

        $form_data['slug'] = $slug;

        $newMessage = new Message();
        $newMessage->fill($form_data);

        $newMessage->save();

        return response()->json(['success' => 'Message created!', 'results' => $newMessage]);
    }
    public function index()
    {
        $messages = Message::all();
        return response()->json([
            'success' => true,
            'results' => $messages
        ]);
    }
}
