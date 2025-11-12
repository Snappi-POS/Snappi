<?php

namespace App\Livewire\Purchases;

use App\Models\MenuItem;
use App\Models\Purchase as ModelPurchase;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Purchase as ModelsPurchase;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use App\Services\InventoryService;

class Purchases extends Component
{
    use WithPagination, LivewireAlert;

    public $showEditPurchaseModal = false;
    public $showPurchaseDetailsModal = false;
    public $confirmDeletePurchase = false;
    public $showFilters = false;
    public $clearFilterButton = false;
    public $filterDateRange;
    public $filterStartDate;
    public $filterEndDate;
    public $search;


    public $selectedPurchases;
    public $deletePurchase;
    public $viewPurchaseDetails;

    public function mount()
    {
        abort_if(!in_array('Expense', restaurant_modules()), 403);
        abort_if((!user_can('Show Expense')), 403);
    }

    #[On('showPurchasesFilters')]
    public function showFiltersSection()
    {
        $this->showFilters = true;
    }

   
    public function showEditPurchase($id)
{
    $this->selectedPurchases = $id; // ✅ pass ID, not model
    $this->showEditPurchaseModal = true;
}

    public function showPurchaseDetails($id)
    {
        $this->showPurchaseDetailsModal = true;
        $this->viewPurchaseDetails = ModelPurchase::find($id);
    }

    public function showDeleteMenupurchase($id)
    {
        $this->deletePurchase = $id;
        $this->confirmDeletePurchase = true;
    }

    public function deletePurchaseData($id)
    {
        $purchase = ModelPurchase::find($id);
        $menuitem = MenuItem::find($purchase->menu_item_id);
        $inventory = app(InventoryService::class);

        $this->confirmDeletePurchase = false;
        $this->deletePurchase = null;

        $inventory->cancelPurchase($menuitem, $purchase->quantity);

        $purchase->delete();

        $this->alert('success', __('messages.purchaseDeleted'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'cancelButtonText' => __('app.close')
        ]);
    }

    public function clearFilters()
    {
        $this->filterStartDate = '';
        $this->filterEndDate = '';
        $this->search = '';
        $this->dispatch('clearMenuItemFilter');
    }


    public function render()
    {

        $query = ModelsPurchase::query()
            ->with(['menuItem.measurement'])
            ->where('branch_id', branch()->id);



        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%')
                    ->orWhere('reference', 'like', '%' . $this->search . '%')
                    ->orWhere('notes', 'like', '%' . $this->search . '%')
                    ->orWhereHas('menuItem', function ($sub) {
                        $sub->where('item_name', 'like', '%' . $this->search . '%');
                    });
            });
            $this->clearFilterButton = true;
        }

        if (!empty($this->filterStartDate) && !empty($this->filterEndDate)) {
            $query->whereBetween('purchase_date', [$this->filterStartDate, $this->filterEndDate]);
            $this->clearFilterButton = true;
        }

        $purchases = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.purchases.purchases', [
            'purchases' => $purchases,
        ]);
    }
}
