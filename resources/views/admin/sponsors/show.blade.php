@extends('layouts.admin')
@section('content')
    <section id="sponsor-page" class="container-fluid p-3">
        <h3 class="text-uppercase">payment</h3>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>The subscription will start today.</p>
        {{-- payment --}}
        <form method="post" id="payment-form"
            action="{{ route('admin.sponsors.payment', ['apSlug' => $apSlug, 'id' => $sponsor->id]) }}">
            @csrf
            <section>
                <label for="amount">
                    <span class="input-label">Price:</span>
                    <div>
                        <div id="amount" class="border-0" readonly>{{ $sponsor->price }} $</div>
                    </div>
                </label>
                <div class="bt-drop-in-wrapper d-flex justify-content-start">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button btn btn-success" type="submit"><span>BUY IT</span></button>
        </form>

    </section>

    <script>
        // payments
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

                    // add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();

                });
            });
        });
    </script>
@endsection
