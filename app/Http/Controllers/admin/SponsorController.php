<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use App\Models\Apartment;
use App\Models\Sponsor;
use Braintree;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartments = Apartment::all();
        $sponsors = Sponsor::all();
        return view("admin.sponsors.index", compact("sponsors", "apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // datas from index's submit request
        $apSlug = $request->apSlug;
        $sponsor = Sponsor::findOrFail($request->id);

        // payments
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();
        return view("admin.sponsors.show", compact("token", "sponsor", "apSlug"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorRequest  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }

    public function payment(Request $request)
    {
        // datas from submit request
        $sponsor = Sponsor::findOrFail($request->id);
        $apartment = Apartment::where('slug', $request->apSlug)->firstOrFail();

        //payment w/Braintree
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $sponsor->price;
        $nonce = $request["payment_method_nonce"];
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            $sponsor->save();
            $nDays = "";
            switch ($request->id) {
                case '0':
                    $nDays = 1;
                    break;
                case '1':
                    $nDays = 3;
                    break;
                case '2':
                    $nDays = 6;
                    break;
                default:
                    break;
            };

            function addDaysToDate($dateOfStart, $nDays)
            {
                $dateOfEnd = date('Y-m-d', strtotime($dateOfStart . ' +' . $nDays . ' days'));
                return $dateOfEnd;
            }
            $dateOfStart = date("Y-m-d");
            $dateOfEnd = addDaysToDate($dateOfStart, $nDays);

            $apartment->sponsors()->attach($sponsor->id, [
                'date_of_start' => $dateOfStart,
                'date_of_end' => $dateOfEnd
            ]);

            return redirect()->route('admin.sponsors.index')->with('success_message', 'Transaction successful. The ID is:' . $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors("An error occurred with the message:" . $result->message);
        }
    }
}
