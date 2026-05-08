<?php

namespace App\Livewire\Dashboard;

use App\Models\Stock;
use App\Traits\HasBranch;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class LowStockItems extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        return view('livewire.dashboard.low-stock-items');
    }

    #[Computed]
    public function stocks()
    {
        return Stock::where('quantity', '<=', 5)->paginate(5);
    }

}
