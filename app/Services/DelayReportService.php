<?php

namespace App\Services;

use App\Enums\DelayStatus;
use App\Models\DelayReport;
use App\Repositories\DelayReportRepository;

class DelayReportService
{
    public function __construct(
        private readonly DelayReportRepository $delayReportRepository
    ) {
    }

    public function delayOrderById($orderId)
    {
        return $this->delayReportRepository->create([
            'order_id' => $orderId,
        ]);
    }

    public function findDelayReportByOrderId($orderId): ?DelayReport
    {
        return $this->delayReportRepository->findDelayReportByOrderId($orderId);
    }

    public function assignTheAgentToTheOldestDelayReport($agentId): bool
    {
        $delayReport = $this->delayReportRepository->getFirstUnAssignedDelayReport();

        if (is_null($delayReport) || $this->agentAlreadyHasDelayReport($agentId)) {
            return false;
        }

        return $this->delayReportRepository->update($delayReport->id, [
            'agent_id' => $agentId,
            'status'   => DelayStatus::InProgress->value
        ]);
    }

    private function agentAlreadyHasDelayReport($agentId): bool
    {
        $delayReport = $this->delayReportRepository->agentAlreadyHasDelayReport($agentId);

        return isset($delayReport);
    }
}
