@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <h1 class="my-4">{{ $apartment->title }}</h1>
                    <h2>Copertina:</h2>
                    <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}" class="w-50">
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
                    <h2>Sponsorship:</h2>
                    <p>
                        @switch($sponsorship)
                            @case(1)
                                Basic
                            @break

                            @case(2)
                                Advanced
                            @break

                            @case(2)
                                Premium
                            @break

                            @default
                        @endswitch
                        , expire at: {{ $sponsorshipEnd }}
                    </p>
                    <a href="{{ route('admin.apartments.index') }}">Torna all'elenco</a>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
@endsection
