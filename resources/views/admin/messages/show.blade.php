@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 m-3">
                <div class="d-flex justify-content-between">
                    <p><strong>Informazioni Messaggio :</strong> {{$message->content}} </p>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-primary">Torna all'elenco</a>
                </div>
            </div>
            <div class="col-12 m-3">
                 <p><strong>Name:</strong> {{$message->name}}</p>
                 <p><strong>Surname:</strong> {{$message->surname}}</p>
                 <p><strong>Email:</strong> {{$message->email}}</p>
                 <p><strong>Slug:</strong> {{$message->slug}}</p>
            </div>
        </div>
    </div>
@endsection