<?php

namespace App\Models;

use App\Enums\TripStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TripStatus::class,
    ];

    protected $guarded = ['id'];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function notDelivered(): bool
    {
        return !$this->delivered();
    }

    public function delivered(): bool
    {
        return $this->status->delivered();
    }
}
