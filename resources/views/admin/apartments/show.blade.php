@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <h1 class="my-4">{{ $apartment->title }}</h1>
                    <h2>Contenuto:</h2>
                    <img src="{{asset('storage/'.$apartment->image)}}" alt="{{$apartment->title}}" class="w-50">
                    <h2>Servizi:</h2>
                        @forelse ($apartment->services as $item)
                            <div>{{ $item->name }}</div>
                            @empty
                            nessuna servizio associato alla locazione

                        @endforelse
                    <h2>Contenuto:</h2>
                    <p>{{ $apartment->content }}</p>
                    <h2>Metrattura:</h2>
                    <p>{{ $apartment->square_feet }}</p>
                    <h2>Numero bagni:</h2>
                    <p>{{ $apartment->bathroom }}</p>
                    <h2>Numero stanze:</h2>
                    <p>{{ $apartment->room }}</p>
                    <h2>Indirizzo:</h2>
                    <p>{{ $apartment->address }}</p>
                    <h2>Coordinate:</h2>
                    <p>{{ $apartment->latitude }} - {{ $apartment->longitude }}</p>
                    <h2>Prezzo:</h2>
                    <p>{{ $apartment->price }}</p>
                    <h2>Cancellazione gratutita:</h2>
                    @if ($apartment->free_cancellation)
                        <p>Si</p>
                    @else
                        <p>No</p>
                    @endif
                    <a href="{{ route('admin.apartments.index') }}">Torna all'elenco</a>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
@endsection