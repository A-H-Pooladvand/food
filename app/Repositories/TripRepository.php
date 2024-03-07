<?php

namespace App\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Trip findById($id)
 */
class TripRepository extends Repository
{
    public function __construct(
        private readonly Trip $trip
    ) {
        parent::__construct();
    }

    public function setModel(): Model
    {
        return $this->trip;
    }

    public function findByOrderId($orderId): ?Trip
    {
        return $this->model::where('order_id', $orderId)->first();
    }
}
