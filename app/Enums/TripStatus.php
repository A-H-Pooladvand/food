<?php

namespace App\Enums;

enum TripStatus: string
{
    case Delivered = 'DELIVERED';
    case Picked    = 'PICKED';
    case AtVendor  = 'AT_VENDOR';
    case Assigned  = 'ASSIGNED';

    public function delivered(): bool
    {
        return $this->value === self::Delivered->value;
    }
}
