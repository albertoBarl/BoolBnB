@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row px-5">
            <div class="col-12 mt-5 text-end">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary">Torna all'elenco</a>
            </div>

            <div class="col-12">
                 <p><strong>Name:</strong> {{$message->name}}</p>
                 <p><strong>Surname:</strong> {{$message->surname}}</p>
                 <p><strong>Email:</strong> {{$message->email}}</p>
            </div>

            <div class="col-12 mt-3">
                <div class="d-flex justify-content-between">
                    <p class="text-wrap"><strong>Messaggio :</strong> {{$message->content}} </p>
                </div>
            </div>
        </div>
    </div>
@endsection