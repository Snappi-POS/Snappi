<?php

namespace App\Livewire\Dashboard;

use App\Models\Restaurant;
use Livewire\Component;

class RestaurantCount extends Component
{

    public $orderCount;
    public $percentChange;
    
    public function mount()
    {
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        $yesterdayStart = now()->subDay()->startOfDay();
        $yesterdayEnd = now()->subDay()->endOfDay();

        $this->orderCount = Restaurant::whereBetween('restaurants.created_at', [$todayStart, $todayEnd])
            ->count();
        
        $yesterdayCount = Restaurant::whereBetween('restaurants.created_at', [$yesterdayStart, $yesterdayEnd])
            ->count();

        $orderDifference = ($this->orderCount - $yesterdayCount);

        $this->percentChange  = (($orderDifference / ($yesterdayCount == 0 ? 1 : $yesterdayCount)) * 100);

    }

    public function render()
    {
        return view('livewire.dashboard.restaurant-count');
    }

}
