<?php

namespace App\Livewire\Stockmovements;

use Livewire\Attributes\On;
use Livewire\Component;

class StockmovementsContent extends Component
{

    public $search;
    public $showAddPurchases = false;
    public $showFilterButton = true;
    public $closeModal = false;

    #[On('hideAddPurchases')]
    public function hideAddPurchases()
    {
        $this->showAddPurchases = false;
    }

    #[On('clearPurchaseFilter')]
    public function clearPurchaseFilter()
    {
        $this->showFilterButton = false;
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.stockmovements.stockmovements-content');
    }

}
