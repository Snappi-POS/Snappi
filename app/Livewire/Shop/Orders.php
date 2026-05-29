<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Orders extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    public $restaurant;

    public function mount()
    {
        if (is_null(customer()))
        {
            return $this->redirect(route('home'));
        }
    }

    public function render()
    {
        $orders = Order::withoutGlobalScopes()
            ->withCount('items')
            ->where('customer_id', customer()->id)
            ->where('status', '<>', 'canceled')
            ->where('status', '<>', 'draft')
            ->orderByDesc('id')
            ->paginate(10);

        return view('livewire.shop.orders', [
            'orders' => $orders,
        ]);
    }

}
