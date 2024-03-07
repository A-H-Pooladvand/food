<?php

namespace App\Services;

use App\Models\Trip;
use App\Repositories\TripRepository;

class TripService
{
    public function __construct(
        private readonly TripRepository $tripRepository
    ) {
    }

    public function findByOrderId($orderId): ?Trip
    {
        return $this->tripRepository->findByOrderId($orderId);
    }
}
