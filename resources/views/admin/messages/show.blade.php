@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mt-5">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-primary">Torna all'elenco</a>
            </div>
            
            <div class="col-md-7 col-sm-12 mt-5 my_justify">
                    <p><strong>Informazioni Messaggio:</strong> {{$message->content}} </p>
            </div>

            <div class="col-12 mt-5">
                 <p><strong>Name:</strong> {{$message->name}}</p>
                 <p><strong>Surname:</strong> {{$message->surname}}</p>
                 <p><strong>Email:</strong> {{$message->email}}</p>
            </div>
        </div>
    </div>
@endsection