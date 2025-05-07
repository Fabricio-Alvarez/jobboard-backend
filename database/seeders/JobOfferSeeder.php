<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobOffer;

class JobOfferSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 ofertas de trabajo de ejemplo
        JobOffer::factory()->count(10)->create();
    }
}
