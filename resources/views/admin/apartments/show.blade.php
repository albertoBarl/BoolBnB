@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
            <a href="{{ route('admin.apartments.index') }}"><button class="btn my_borderbtn">Torna all'elenco <i class="fa-solid fa-reply" class="ms-1"></i></button></a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="">
                    <h1 class="my-4">{{ $apartment->title }}</h1>
                    <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}" class="w-lg-50 w-md-100 w-sm-100 rounded">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <p><strong class="my_pinktext">Servizi:</strong>
                @forelse ($apartment->services as $item)
                    <li>{{ $item->name }}</li>
                @empty
                    nessuna servizio associato alla locazione
                @endforelse
                </p>
                <p class="my_justify"><strong class="my_pinktext">Descrizione:</strong> {{ $apartment->description }}</p>
                <p><strong class="my_pinktext">Metratura:</strong> {{ $apartment->square_feet }}m&#178;</p>
                <p><strong class="my_pinktext">Numero stanze:</strong> {{ $apartment->room }}</p>
                <p><strong class="my_pinktext">Numero letti:</strong> </p>
                <p><strong class="my_pinktext">Numero bagni:</strong> {{ $apartment->bathroom }}</p>
                <p><strong class="my_pinktext">Indirizzo:</strong> {{ $apartment->address }}</p>
                <p><strong class="my_pinktext">Sponsorship:</strong>
                    @if ($sponsorship)
                        {{ $sponsorship }}, expire at: {{ $sponsorshipEnd }}
                    @else
                        Struttura non sponsorizzata.
                    @endif
                </p>
            </div>
            <div class="col-sm-0 col-md-6 col-lg-6"></div>
        </div>
        <div class="row mb-5 mt-3">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <a href="{{ route('admin.sponsors.index') }}"><button class="btn my_solidbtn w-100">Sponsorizza la struttura</button></a>
            </div>
        </div>
    </div>
@endsection
