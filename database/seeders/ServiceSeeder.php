<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'POS System',
            'price' => 650.99,
            'description' => null
        ]);

        Service::create([
            'name' => 'Loan System',
            'price' => 999.99,
            'description' => null
        ]);

        Service::create([
            'name' => 'Cloud Storage',
            'price' => 20.00,
            'description' => null
        ]);

        Service::create([
            'name' => 'Installation Fee',
            'price' => 20.00,
            'description' => null
        ]);
    }
}
