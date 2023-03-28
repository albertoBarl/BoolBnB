<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('db_apartments.apartments');

        foreach ($apartments as $apartment) {
            $newApartment = new Apartment();

            $newApartment->user_id = $apartment['user_id'];
            $newApartment->title = $apartment['title'];
            $newApartment->description = $apartment['description'];
            $newApartment->square_feet = $apartment['square_feet'];
            $newApartment->bathroom = $apartment['bathroom'];
            $newApartment->room = $apartment['room'];
            $newApartment->address = $apartment['address'];
            $newApartment->image = $apartment['image'];
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->slug = Apartment::genSlug($newApartment->title, "-");
            $newApartment->price = $apartment['price'];

            $newApartment->save();
        };
    }
}
