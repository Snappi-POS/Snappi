<?php

namespace App\Livewire\Dashboard;

use App\Models\MenuItem;
use App\Scopes\AvailableMenuItemScope;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TodayMenuItemEarnings extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $menuItems = MenuItem::withoutGlobalScope(AvailableMenuItemScope::class)
            ->todayPaidOrders()
            ->withSum(['orders as total_quantity' => function ($query) {
                $query->whereHas('order', fn($q) => $q->where('status', 'paid'))
                    ->whereDate('created_at', today());
            }], 'quantity')
            ->orderByDesc('total_quantity')
            ->paginate(5, pageName: 'top-selling');

        return view('livewire.dashboard.today-menu-item-earnings', compact('menuItems'));
    }
}
