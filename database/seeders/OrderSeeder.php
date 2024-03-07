<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;

class OrderSeeder extends Seeder
{
    public function __construct(
        private readonly UserRepository $repository
    ) {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->repository->take(10)->random(10)->each(function (User $user) {
            Order::factory()->create([
                'user_id' => $user->id,
                'vendor_id' => Vendor::inRandomOrder()->first()->id
            ]);
        });
    }
}
