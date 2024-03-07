<?php

namespace App\Repositories;

use App\Models\DelayReport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DelayReportRepository extends Repository
{
    public function __construct(
        private readonly DelayReport $delayReport
    ) {
        parent::__construct();
    }

    public function setModel(): Model
    {
        return $this->delayReport;
    }

    public function findDelayReportByOrderId($orderId): ?DelayReport
    {
        return $this->model()->where('order_id', $orderId)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getFirstUnAssignedDelayReport(): DelayReport|null
    {
        return $this->model()
            ->whereNull('status')
            ->whereNull('agent_id')
            ->whereNull('followed_up_at')
            ->oldest()
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function agentAlreadyHasDelayReport($agentId): DelayReport|null
    {
        return $this->model()
            ->where('agent_id', $agentId)
            ->whereNotNull('status')
            ->whereNull('followed_up_at')
            ->first();
    }
}
