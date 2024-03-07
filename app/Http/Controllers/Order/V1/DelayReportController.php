<?php

namespace App\Http\Controllers\Order\V1;

use Response;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DelayReportController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {
    }

    /**
     * @throws \App\Exceptions\MockyException
     */
    public function __invoke($orderId, Request $request)
    {
        // Validate order.user_id === Auth::id()

        return $this->orderService->handleDelayReport($orderId);
    }
}
