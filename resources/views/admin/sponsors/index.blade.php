@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid p-3">
        <h3 class="text-uppercase">available sponsorhips</h3>
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        {{-- cards --}}
        <div class="row gap-2 gap-lg-5">
            @foreach ($sponsors as $sponsor)
                <div class="col-12 col-lg-3 card p-2 d-flex justify-content-center align-items-center">
                    <h5 class="card-title text-center text-uppercase bg-light form-control">
                        {{ $sponsor->title }}</h5>
                    <p class="card-body"><strong>"Highlights"</strong> your apartment for
                        <strong>{{ $sponsor->duration }}</strong>
                        hours for only <strong>${{ $sponsor->price }}</strong>.
                    </p>

                    <form action="{{ route('admin.sponsors.show', ['id' => $sponsor->id]) }}" method="get"
                        class="d-flex flex-column justify-content-center align-items-center">
                        <label for="apartment_id">Select an apartment:</label>
                        <select class="form-select mb-2" name="apSlug" id="apartment_id">
                            @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->slug }}">{{ $apartment->title }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">
                        <button type="submit" class="mybtn btn btn-light">Submit</button>
                    </form>
                </div>
            @endforeach
        </div>


    </section>
@endsection
