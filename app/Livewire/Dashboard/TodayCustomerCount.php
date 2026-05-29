<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;

class TodayCustomerCount extends Component
{

    public $orderCount;
    public $percentChange;
    
    public function mount()
    {
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        $yesterdayStart = now()->subDay()->startOfDay();
        $yesterdayEnd = now()->subDay()->endOfDay();

        $this->orderCount = Order::whereBetween('orders.date_time', [$todayStart, $todayEnd])
            ->where('status', '<>', 'canceled')
            ->where('status', '<>', 'draft')
            ->distinct()->count('customer_id');
        
        $yesterdayCount = Order::whereBetween('orders.date_time', [$yesterdayStart, $yesterdayEnd])
            ->where('status', '<>', 'canceled')
            ->where('status', '<>', 'draft')
            ->distinct()->count('customer_id');

        $orderDifference = ($this->orderCount - $yesterdayCount);

        $this->percentChange  = (($orderDifference / ($yesterdayCount == 0 ? 1 : $yesterdayCount)) * 100);

    }
    
    public function render()
    {
        return view('livewire.dashboard.today-customer-count');
    }

}
