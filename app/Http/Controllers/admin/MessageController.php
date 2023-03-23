<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Controllers\Controller;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

//g
    public function create()
    {
        return view('admin.messages.create');
    }

    public function store(StoreMessageRequest $request)
    {
        $form_data = $request->validated();

        $slug = Message::generateSlug($request->name);

        $form_data['slug'] = $slug; 
        
        // $form_data['apartment_id'] = auth()->user()->id;

        $newMessage = new Message();
        $newMessage->fill($form_data);

        $newMessage->save();

        return redirect()->route('admin.messages.index')->with('message','Progetto creato correttamente');
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }
}
