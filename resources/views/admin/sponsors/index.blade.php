@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid p-3">
        <h3 class="text-uppercase">available sponsorhips</h3>
        <div class="d-flex align-items-center gap-5">
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

            <form action="{{ route('admin.sponsors.store') }}" method="POST">
                {{-- {{ route('admin.sponsorships.store') }} --}}
                @csrf
                <div id="formAp" class="form-group my-3">
                    {{-- apartment_id --}}
                    <label class="control-label">Select an apartment:</label>
                    <select name="apartment_id" id="apartment">
                        @foreach ($apartments as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                    {{-- sponsor_id --}}
                    <input type="tel" name="sponsorship_price" id="sponsorship_price" value="" readonly>
                </div>
                <p>The subscription will start today.</p>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-sm btn-success">Subscribe</button>
                </div>
            </form>
        </div>

        {{-- cards --}}
        <div class="row gap-2 gap-lg-5">
            @foreach ($sponsors as $item)
                <div class="col-12 col-lg-3 card p-2">
                    <h5 class="card-title text-center text-uppercase">{{ $item->title }}</h5>
                    <p class="card-body"><strong>"Highlights"</strong> your apartment for
                        <strong>{{ $item->duration }}</strong>
                        hours for only <strong>${{ $item->price }}</strong>.
                    </p>
                    <button type="button" class="mybtn btn btn-light" value="{{ $item->price }}"
                        onclick="getPrice({{ $item->price }})" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">${{ $item->price }}</button>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                            @csrf
                            <section>
                                <label for="amount">
                                    <span class="input-label">Amount</span>
                                    <div class="input-wrapper amount-wrapper">
                                        <input id="amount" name="amount" type="tel" min="1"
                                            placeholder="Amount" value="" readonly>
                                    </div>
                                </label>
                                <div class="bt-drop-in-wrapper d-flex justify-content-start">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button class="button btn btn-success" type="submit"><span>BUY IT</span></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        // payments
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        function getPrice(price) {
            let priceOf = document.getElementById("amount");
            priceOf.value = price;

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


        // disable buttons on payment success
        // const buttonsToDisable = document.querySelectorAll('.mybtn');
        // // Disabilita i bottoni selezionati
        // buttonsToDisable.forEach(button => {
        //     button.disabled = true;
        // });
    </script>

@endsection
