@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid p-3">
        <h3 class="text-uppercase">available sponsorhips</h3>

        {{-- cards --}}
        <div class="row gap-2 gap-lg-5">
            @foreach ($sponsors as $item)
                <div class="col-12 col-lg-3 card p-2">
                    <h5 class="card-title text-center text-uppercase">{{ $item->title }}</h5>
                    <p class="card-body"><strong>"Highlights"</strong> your apartment for
                        <strong>{{ $item->duration }}</strong>
                        hours for only <strong>${{ $item->price }}</strong>.
                    </p>
                    <form action="{{ route('admin.sponsors.show') }}">
                        <select name="apartment_id" id="apartment_id">
                            @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="mybtn btn btn-light" value="{{ $item->price }}"
                            onclick="getPrice({{ $item->price }})" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">${{ $item->price }}</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <script>
        function getPrice(price) {
            let sponsorshipPrice = document.getElementById("sponsorship_price");
            let formAp = document.getElementById("formAp");
            switch (sponsorshipPrice.value = price) {
                case 2.99:
                    sponsorshipPrice.value = "Basic";
                    break;
                case 5.99:
                    sponsorshipPrice.value = "Advanced";
                    break;
                case 9.99:
                    sponsorshipPrice.value = "Premium";
                    break;
                default:
                    break;
            }
        }
    </script>
@endsection
