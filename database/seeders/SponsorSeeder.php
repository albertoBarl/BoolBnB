<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                "title" => "Basic",
                "price" => "2.99",
                "duration" => "24",
            ],
            [
                "title" => "Advanced",
                "price" => "5.99",
                "duration" => "72",
            ],
            [
                "title" => "Premium",
                "price" => "9.99",
                "duration" => "144",
            ],
        ];
        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor();
            $newSponsor->title = $sponsor["title"];
            $newSponsor->slug = Sponsor::genSlug($newSponsor->title, "-");
            $newSponsor->price = $sponsor["price"];
            $newSponsor->duration = $sponsor["duration"];

            $newSponsor->save();
        }
    }
}
