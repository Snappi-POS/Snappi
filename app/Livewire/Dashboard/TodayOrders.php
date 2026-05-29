<?php

namespace App\Livewire\Dashboard;

use App\Events\TodayOrdersUpdated;
use App\Models\Kot;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TodayOrders extends Component
{

    use LivewireAlert;

    public function render()
    {
        $start = now()->startOfDay();
        $end = now()->endOfDay();

        $count = Order::whereBetween('orders.date_time', [$start, $end])
            ->where('status', '<>', 'canceled')
            ->where('status', '<>', 'draft')
            ->count();

        $todayKotCount = Kot::join('orders', 'kots.order_id', '=', 'orders.id')
            ->whereBetween('kots.created_at', [$start, $end])
            ->where('orders.status', '<>', 'canceled')
            ->where('orders.status', '<>', 'draft')
            ->count();

        $playSound = false;

        if (session()->has('today_order_count') && session('today_order_count') < $todayKotCount) {
            $playSound = true;

            $this->alert('success', __('messages.newOrderReceived'), [
                'toast' => true,
                'position' => 'top-end'
            ]);

            $this->dispatch('refreshOrders');
        }

        session(['today_order_count' => $todayKotCount]);


        return view('livewire.dashboard.today-orders', [
            'count' => $count,
            'playSound' => $playSound,
        ]);
    }

    /**
     * Handle refresh from Pusher event
     */
    public function refreshOrders()
    {
        // This method will be called when Pusher sends data
        // The component will automatically re-render with fresh data
        $this->dispatch('$refresh');
    }
}
