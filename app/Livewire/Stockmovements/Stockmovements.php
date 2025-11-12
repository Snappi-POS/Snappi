<?php

namespace App\Livewire\Stockmovements;

use App\Models\StockMovement;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class StockMovements extends Component
{
    use WithPagination, LivewireAlert;

    public $showFilters = false;
    public $clearFilterButton = false;
    public $filterStartDate;
    public $filterEndDate;
    public $search;

    #[On('showStockMovementsFilters')]
    public function showFiltersSection()
    {
        $this->showFilters = true;
    }

    public function clearFilters()
    {
        $this->filterStartDate = '';
        $this->filterEndDate = '';
        $this->search = '';
        $this->dispatch('clearStockMovementsFilter');
    }

    public function render()
    {
        $query = StockMovement::with(['menuItem', 'measurement'])
            ->where('branch_id', branch()->id);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('type', 'like', '%' . $this->search . '%')
                    ->orWhere('reference_type', 'like', '%' . $this->search . '%')
                    ->orWhere('notes', 'like', '%' . $this->search . '%')
                    ->orWhereHas('menuItem', function ($sub) {
                        $sub->where('item_name', 'like', '%' . $this->search . '%');
                    });
            });
            $this->clearFilterButton = true;
        }

        if (!empty($this->filterStartDate) && !empty($this->filterEndDate)) {
            $query->whereBetween('created_at', [$this->filterStartDate, $this->filterEndDate]);
            $this->clearFilterButton = true;
        }

        $stockMovements = $query->orderByDesc('id')->paginate(10);

        return view('livewire.stockmovements.stockmovements', [
            'stockMovements' => $stockMovements,
        ]);
    }
}
