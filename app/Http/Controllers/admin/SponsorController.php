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
    public function index()
    {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();
        $sponsors = Sponsor::all();
        $apartments = Apartment::all();
        return view("admin.sponsors.index", compact("sponsors", "apartments", 'token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartments = Apartment::all();
        return view(compact('apartments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorRequest $request)
    {
        $form_data = $request->all();
        $sponsorship = Sponsor::create($form_data);
        // $sponsor = new Sponsor();
        $apartmentId = $request->input("apartment_id");
        $sponsorshipReq = $request->input('sponsorship_price');
        $sponsorId = "";
        $nDays = "";
        switch ($sponsorshipReq) {
            case 'Basic':
                $sponsorId = 0;
                $nDays = 1;
                break;
            case 'Advanced':
                $sponsorId = 1;
                $nDays = 3;
                break;
            case 'Premium':
                $sponsorId = 2;
                $nDays = 6;
                break;
            default:
                break;
        };

        $dateOfStart = date("Y-m-d");
        $dateOfEnd = addDaysToDate($dateOfStart, $nDays);
        function addDaysToDate($dateOfStart, $nDays)
        {
            $dateOfEnd = date('Y-m-d', strtotime($dateOfStart . ' +' . $nDays . ' days'));
            return $dateOfEnd;
        }

        if ($request->has('apartments')) {
            $sponsorship->apartments()->attach($apartmentId, ['sponsor_id' => $sponsorId], ['date_of_start' => $dateOfStart], ['date_of_end' => $dateOfEnd]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        return view("admin.sponsors.show", compact("sponsor"));
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
}
