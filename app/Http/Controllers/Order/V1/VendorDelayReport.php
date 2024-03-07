<?php

namespace App\Http\Controllers\Order\V1;

use App\Services\OrderService;
use App\Http\Controllers\Controller;

class VendorDelayReport extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {
    }

    public function __invoke()
    {
        return apiResponse()->ok([
            'data' => $this->orderService->vendorDelayReport()
        ]);
    }
}
