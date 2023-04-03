@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid p-3">
        <h3 class="text-uppercase">available sponsor</h3>
        <div class="row gap-2 gap-lg-5">
            @foreach ($sponsors as $item)
                <div class="col-12 col-lg-3 card p-2">
                    <h5 class="card-title text-center text-uppercase">{{ $item->title }}</h5>
                    <p class="card-body">Metti in <strong>"evidenza"</strong> il tuo appartamento per {{ $item->duration }}
                        ore a soli <span class="p-1">${{ $item->price }}</span>.
                    </p>
                </div>
            @endforeach
        </div>
    </section>

    <form action="#" method="POST">
        {{-- {{ route('admin.sponsorships.store') }} --}}
        @csrf
        <div class="form-group my-3">
            <label class="control-label">Select a sponsorship:</label>
            <select name="sponsor" id="sponsor">
                @foreach ($sponsors as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group my-3">
            <label class="control-label">Select an apartment:</label>
            <select name="apartment" id="apartment">
                @foreach ($apartments as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group my-3">
            <label class="control-label"></label>
            <input type="date" name="date_of_start" value="date_of_start">
        </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-sm btn-success">Subscribe</button>
        </div>
    </form>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" id="payment-form" action="{{ url('/checkout') }}">
        @csrf
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>

    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection
