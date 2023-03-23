<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['wi-fi', 'Vista sul lago', 'Vista sulle montagne', 'Piscina', 'TV via cavo standard', 'Parcheggio gratuito nella proprietà', 'Cucina', 'Climatizzatore portatile'];

        foreach ($services as $item) {
            $newType = new Service();
            $newType->name = $item;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->save();
        }
    }
}
