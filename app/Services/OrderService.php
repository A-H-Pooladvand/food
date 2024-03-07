<?php

namespace App\Services;

use Http;
use Illuminate\Http\JsonResponse;
use App\Exceptions\MockyException;
use Illuminate\Support\Collection;
use App\Utilities\Response\Response;
use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(
        protected OrderRepository $orderRepository,
        protected TripService $tripService,
        protected DelayReportService $delayReportService,
    ) {
    }

    /**
     * @throws \App\Exceptions\MockyException
     */
    public function handleDelayReport($id): JsonResponse
    {
        $order = $this->orderRepository->findById($id);

        if (is_null($order)) {
            return apiResponse()->withMessage('Order not found')->notFound();
        }

        if ($order->delivered()) {
            return apiResponse()->withMessage('Order already delivered')->ok([]);
        }

        if ($order->notDelayed()) {
            return apiResponse()
                ->withMessage('Your order is on track and not experiencing any delays')
                ->badRequest();
        }

        $trip = $this->tripService->findByOrderId($order->id);
        $delayReport = $this->delayReportService->findDelayReportByOrderId($order->id);

        if (
            is_null($delayReport) && // There is no row in delay_reports for this order_id
            (is_null($trip) || $trip->notDelivered())

        ) {
            // Put order in delay_reports
            $this->delayReportService->delayOrderById($order->id);

            return apiResponse()
                ->withMessage('Your request has been placed in the follow-up queue. Please wait')
                ->ok([]);
        }

        return apiResponse()->ok(
            $this->estimate()
        );
    }

    /**
     * @throws \App\Exceptions\MockyException
     */
    public function estimate()
    {
        $response = Http::get('https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7');

        if ($response->successful()) {
            return $response->json('data.eta');
        }

        throw new MockyException();
    }

    public function vendorDelayReport():Collection
    {
        return $this->orderRepository->vendorDelayReport();
    }
}
