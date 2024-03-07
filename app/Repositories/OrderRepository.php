<?php

namespace App\Repositories;

use DB;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Order|null findById($id)
 */
class OrderRepository extends Repository
{
    public function __construct(
        private readonly Order $order
    ) {
        parent::__construct();
    }

    public function setModel(): Model
    {
        return $this->order;
    }

    public function vendorDelayReport(): Collection
    {
        return Order::select([
            'vendor_id',
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, delivery_time, orders.created_at)) as total_delay_minutes'),
            'vendors.name'
        ])
            ->whereBetween('orders.created_at', [now()->subWeek(), now()])
            ->groupBy('vendor_id')
            ->join('vendors', 'orders.vendor_id', '=', 'vendors.id')
            ->orderByDesc('total_delay_minutes')
            ->get();
    }
}
