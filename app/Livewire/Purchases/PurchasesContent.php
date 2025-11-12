<?php

namespace App\Livewire\Purchases;

use Livewire\Attributes\On;
use Livewire\Component;

class PurchasesContent extends Component
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
        return view('livewire.purchases.purchases-content');
    }

}
