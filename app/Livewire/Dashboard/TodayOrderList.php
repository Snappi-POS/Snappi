<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class TodayOrderList extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $listeners = ['refreshOrders' => '$refresh'];

    public function render()
    {
        $start = now()->startOfDay();
        $end = now()->endOfDay();

        $orders = Order::withCount('items')->with('table', 'waiter')
            ->where('status', '<>', 'canceled')
            ->where('status', '<>', 'draft')
            ->orderBy('id', 'desc')
            ->whereBetween('orders.date_time', [$start, $end])
            ->paginate(10);

        return view('livewire.dashboard.today-order-list', [
            'orders' => $orders
        ]);
    }

}
