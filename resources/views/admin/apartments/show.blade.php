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
                    @if (Str::contains($apartment->image, 'post_images'))
                    <img src="{{asset('storage/' .$apartment->image)}}" alt="">
                    @else
                    <img class="card-img-top my_cardimg rounded" src="{{ $apartment->image }}" alt="">
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <p><strong class="my_pinktext">Servizi:</strong>
                @forelse ($apartment->services as $item)
                    <li class="my_servicesli">{{ $item->name }}</li>
                @empty
                    nessuna servizio associato alla locazione
                @endforelse
                </p>
                <p class="my_justify"><strong class="my_pinktext">Descrizione:</strong> {{ $apartment->description }}</p>
                <p><strong class="my_pinktext">Metratura:</strong> {{ $apartment->square_feet }}m&#178;</p>
                <p><strong class="my_pinktext">Numero stanze:</strong> {{ $apartment->room }}
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

        <!-- <h6>Bathrooms:</h6>
            <p>{{ $apartment->bathroom }} @if ($apartment->bathroom > 1)
                    bathrooms.
                @else
                    bathroom.
                @endif
            </p>
        <h6>Bedrooms:</h6>
            <p>{{ $apartment->room }} room with {{ $apartment->bed }} @if ($apartment->bed > 1)
                    beds.
                @else
                    bed.
                @endif
            </p> -->
    </div>
@endsection
