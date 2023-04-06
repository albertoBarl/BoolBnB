@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 py-4">
                <h1>{{ $apartment->title }}</h1>
                <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}" class="img-fluid me-2">
                <div class="w-100 w-sm-50">
                    <h6>Description:</h6>
                    <p>{{ $apartment->description }}</p>
                    <h6>Address:</h6>
                    <p>{{ $apartment->address }}</p>
                    <h6>Square meters:</h6>
                    <p>{{ $apartment->square_feet }}&#13217;</p>
                    <h6>Bathrooms:</h6>
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
                    </p>
                    <h6>Sponsorship:</h6>
                    <p>
                        @if ($sponsorship)
                            {{ $sponsorship }}, expire at: {{ $sponsorshipEnd }}
                        @else
                            Apartment not sponsorized.
                        @endif
                    </p>
                    <h6>Servizi:</h6>
                    @forelse ($apartment->services as $item)
                        <div>{{ $item->name }}</div>
                    @empty
                        No services founded.
                    @endforelse

                </div>
                <a href="{{ route('admin.apartments.index') }}">Torna all'elenco</a>
            </div>
        </div>
    </div>
@endsection
