<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $form_data = $request->all();

        // slug generation
        $slug = Apartment::genSlug($request->title);
        $form_data['slug'] = $slug;

        // coordinates from address
        $address = $form_data["address"];
        $client = new \GuzzleHttp\Client([
            "verify" => false
        ]);
        $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
            'query' => [
                'key' => 'MYWgMG9kDFQDLg79CP4I0LkOdQCPItNn'
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        $latitude = $result['results'][0]['position']['lat'];
        $longitude = $result['results'][0]['position']['lon'];
        $form_data['latitude'] = $latitude;
        $form_data['longitude'] = $longitude;


        if ($request->has('image')) {
            $path = Storage::disk('public')->put('post_images', $request->image);

            $form_data['image'] = $path;
        }

        $form_data['user_id'] = auth()->user()->id;
        $newApartment = Apartment::create($form_data);

        if ($request->has('services')) {
            $newApartment->services()->attach($request->services);
        }

        return redirect()->route('admin.apartments.index')->with('message', 'Appartamento creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->sponsors->isNotEmpty()) {
            $sponsorship = $apartment->sponsors->first()->pivot->sponsor_id;
            switch ($sponsorship) {
                case 1:
                    $sponsorship = "Basic";
                    break;
                case 2:
                    $sponsorship = "Advanced";
                    break;
                case 3:
                    $sponsorship = "Premium";
                    break;

                default:
                    break;
            }
            $sponsorshipEnd = $apartment->sponsors->first()->pivot->date_of_end;
        } else {
            $sponsorship = null;
            $sponsorshipEnd = null;
        }

        return view('admin.apartments.show', compact('apartment', "sponsorship", "sponsorshipEnd"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        return view('admin.apartments.edit', compact('services', 'apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->validated();

        $slug = Apartment::genSlug($request->title, '-');
        $form_data['slug'] = $slug;

        if ($request->has('image')) {
            //SECONDO CONTROLLO PER CANCELLARE IL FILE PRECEDENTE SE PRESENTE
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $path = Storage::disk('public')->put('post_images', $request->image);

            $form_data['image'] = $path;
        }

        $apartment->update($form_data);

        if ($request->has('services')) {
            // $apartment->services()->detach();
            // $apartment->services()->attach($request->services);
            //sono uguali sopra e sotto

            $apartment->services()->sync($request->services);
        }

        return redirect()->route('admin.apartments.index')->with('message', 'Appartamento modficato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('message', 'Appartamento eliminato correttamente');
    }
}
