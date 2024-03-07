<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Enums\TripStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trip::create([
            'status' => TripStatus::AtVendor,
            'order_id' => 1
        ]);
    }
}
