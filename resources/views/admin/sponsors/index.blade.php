@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid pt-5">
        
        <h2>Sponsors</h2>
        <p>Un appartamento sponsorizzato apparirà in alto nell'home page.</p>

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        {{-- cards --}}
        <div class="row mt-5 ms-1">
            @foreach ($sponsors as $sponsor)
                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-3 card me-lg-3 mb-3 p-3 d-flex justify-content-center align-items-center my_sponsorcard">

                    <h5 class="card-title my_sponsortitle text-center text-uppercase bg-light form-control"><strong>{{ $sponsor->title }}</strong></h5>
                    <p class="card-body text-center mb-0"><strong>Metti in evidenza</strong> il tuo appartamento per <strong>{{ $sponsor->duration }} ore</strong> a soli <strong>{{ $sponsor->price }}&euro;</strong>.</p>

                    <form action="{{ route('admin.sponsors.show', ['id' => $sponsor->id]) }}" method="get" class="d-flex flex-column justify-content-center align-items-center">

                        <label for="apartment_id" class="mb-3">Seleziona un appartamento:</label>

                        <select class="form-select mb-2 border-0" name="apSlug" id="apartment_id">
                            @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->slug }}">{{ $apartment->title }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">
                        <button type="submit" class="mybtn btn btn-outline-light mt-3">Compra ora</button>
                    </form>
                </div>
            @endforeach
        </div>


    </section>
@endsection
