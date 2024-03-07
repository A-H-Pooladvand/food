<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $casts = [
        'delivery_time' => 'datetime',
    ];

    use HasFactory;

    protected $guarded = ['id'];

    public function trip(): HasOne
    {
        return $this->hasOne(Trip::class);
    }

    public function delayed(): bool
    {
        return $this->delivery_time->isBefore($this->created_at);
    }

    public function notDelayed(): bool
    {
        return !$this->delayed();
    }

    public function delivered(): bool
    {
        return isset($this->delivered_at);
    }
}
