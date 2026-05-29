<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WeeklySalesChart extends Component
{

    public function render()
    {
        $startOfMonth = now()->startOfMonth()->startOfDay();
        $tillToday = now()->endOfDay();

        $startOfLastMonth = now()->subMonth()->startOfMonth()->startOfDay();
        $endOfLastMonth = now()->subMonth()->endOfMonth()->endOfDay();

        $salesData = Order::select(
            DB::raw('DATE(date_time) as date'),
            DB::raw('SUM(total) as total_sales')
        )
            ->whereBetween('orders.date_time', [$startOfMonth, $tillToday])
            ->where('status', 'paid')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyEarnings = Order::whereBetween('orders.date_time', [$startOfMonth, $tillToday])
            ->where('status', 'paid')
            ->sum('total');

        $previousEarnings = Order::whereBetween('orders.date_time', [$startOfLastMonth, $endOfLastMonth])
            ->where('status', 'paid')
            ->sum('total');

        $orderDifference = ($monthlyEarnings - $previousEarnings);

        $percentChange  = (($orderDifference / ($previousEarnings == 0 ? 1 : $previousEarnings)) * 100);
        
        return view('livewire.dashboard.weekly-sales-chart', [
            'salesData' => $salesData,
            'monthlyEarnings' => $monthlyEarnings,
            'percentChange' => $percentChange,
        ]);
    }

}
