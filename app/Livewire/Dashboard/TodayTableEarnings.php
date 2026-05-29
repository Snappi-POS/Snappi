<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TodayTableEarnings extends Component
{

    public function render()
    {
        $start = now()->startOfDay();
        $end = now()->endOfDay();

        $orders = Order::select('table_id', DB::raw('SUM(total) as total_price'))
            ->with('table')
            ->whereNotNull('table_id')
            ->whereBetween('date_time', [$start, $end])
            ->where('status', 'paid')
            ->groupBy('table_id')
            ->orderByDesc('total_price')
            ->limit(5)
            ->get();

        return view('livewire.dashboard.today-table-earnings', [
            'orders' => $orders
        ]);
    }

}
