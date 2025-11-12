<?php

namespace App\Livewire\Purchases;

use App\Models\Purchase;
use App\Models\Branch;
use App\Models\MenuItem;
use App\Models\Measurement;
use App\Services\InventoryService;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class PurchaseList extends Component
{
    use WithPagination, LivewireAlert;

    // UI states
    public $showAddPurchases = false;
    public $showEditPurchaseModal = false;
    public $showPurchaseDetailsModal = false;
    public $confirmDeletePurchase = false;
    public $showFilters = false;
    public $clearFilterButton = false;

    // Filtering
    public $filterCategories = [];
    public $filterPaymentMethods = [];
    public $filterStartDate;
    public $filterEndDate;
    public $search;

    // Form fields
    public $purchase_id;

    public $menu_item_id;
    public $quantity;
    public $price;
    public $reference;
    public $notes;

    // Dropdown data
    public $menuItems;

    // helpers
    public $selectedPurchase;
    public $deletePurchase;
    public $viewPurchaseDetails;

    public $purchase_date;
    public $measurementOptions = []; // available measures for selected product
    public $selectedMeasure = null;  // user’s choice



    public function mount()
    {
        // preload dropdowns
        $this->menuItems = MenuItem::all();
        $this->measurementOptions = Measurement::all();
    }

    // Listen for closing the add modal (if you dispatch this from blade)
    #[On('hideAddPurchase')]
    public function hideAddPurchases()
    {
        $this->showAddPurchases = false;
        $this->resetForm();
    }


    public function updateMenuItemId($value)

    {
        dd("Fireded with value: " . $value);


        $this->measurementOptions = []; // reset first


        if ($value) {
            $menuItem = MenuItem::find($value);
            dd($menuItem);

            if ($menuItem && $menuItem->measurement_id) {
                $measurement = Measurement::find($menuItem->measurement_id);

                if ($measurement) {
                    $this->measurementOptions[] = [
                        'type' => 'main',
                        'label' => $measurement->mainmeasure,
                    ];

                    if ($measurement->submeasure) {
                        $this->measurementOptions[] = [
                            'type' => 'sub',
                            'label' => $measurement->submeasure,
                        ];
                    }

                    $this->selectedMeasure = 'main';
                }
            }
        } else {
            $this->selectedMeasure = null;
        }
    }



    private function resetForm()
    {
        $this->purchase_id = null;
        $this->menu_item_id = '';
        $this->quantity = '';
        $this->price = '';
        $this->reference = '';
        $this->notes = '';
        $this->purchase_date = now()->format('Y-m-d\TH:i');
    }

    /**
     * Save (create or update) purchase and update stock
     */
    public function save()
    {
        $this->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|numeric|min:0.01',
            'price' => 'nullable|numeric|min:0',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
            'purchase_date' => 'required|date',
        ]);

        $inventory = app(InventoryService::class);
        $menuItem = MenuItem::findOrFail($this->menu_item_id);

        $finalQuantity = $this->quantity;

        if ($this->selectedMeasure === 'main') {
            $finalQuantity = $this->quantity;
        } elseif ($this->selectedMeasure === 'sub' && $menuItem && $menuItem->quantity_in_measure) {
            $finalQuantity = $this->quantity * $menuItem->quantity_in_measure;
        }

        if ($this->purchase_id) {
            // update existing purchase -> adjust stock with difference
            $purchase = Purchase::findOrFail($this->purchase_id);
            $oldQty = (float) $purchase->quantity;

            $purchase->update([
                'branch_id' => branch()->id,
                'menu_item_id' => $this->menu_item_id,
                'quantity' => $finalQuantity,
                'price' => $this->price,
                'reference' => $this->reference,
                'notes' => $this->notes,
                'purchase_date' => $this->purchase_date,
            ]);

            $delta = (float)$finalQuantity - $oldQty;
            if ($delta != 0) {
                // Use adjustStock for differences (positive -> add, negative -> deduct)
                $inventory->adjustStock($menuItem, $delta, 'Purchase updated adjustment');
            }

            $this->alert('success', __('messages.purchaseUpdated') ?? 'Purchase updated', [
                'toast' => true,
                'position' => 'top-end',
            ]);
        } else {

            // create new purchase and add stock
            $purchase = Purchase::create([
                'branch_id' => branch()->id,
                'menu_item_id' => $this->menu_item_id,
                'quantity' => $finalQuantity,
                'price' => $this->price,
                'reference' => $this->reference,
                'notes' => $this->notes,
                'purchase_date' => $this->purchase_date,
            ]);

            // Add stock using existing InventoryService method
            $inventory->addPurchase($menuItem, (float)$finalQuantity, $purchase->id);

            $this->alert('success', __('messages.purchaseSaved') ?? 'Purchase saved and stock updated', [
                'toast' => true,
                'position' => 'top-end',
            ]);
        }

        // Reset form and close modal
        $this->resetForm();
        $this->showAddPurchases = false;

        // notify other components / refresh lists
        // $this->emit('purchaseAdded');
        $this->resetPage();
    }

    // Open edit modal and populate form
    public function showEditPurchase($id)
    {
        $purchase = Purchase::findOrFail($id);

        $this->purchase_id = $purchase->id;
        $this->branch()->id;
        $this->menu_item_id = $purchase->menu_item_id;
        $this->quantity = $purchase->quantity;
        $this->price = $purchase->price;
        $this->reference = $purchase->reference;
        $this->notes = $purchase->notes;
        $this->purchase_date = $purchase->purchase_date ? $purchase->purchase_date->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i');
        $this->showEditPurchaseModal = true;
    }

    // View details in right modal
    public function showPurchaseDetails($id)
    {
        $this->viewPurchaseDetails = Purchase::findOrFail($id);
        $this->showPurchaseDetailsModal = true;
    }

    // Prepare delete confirmation
    public function showDeletePurchase($id)
    {
        $this->deletePurchase = $id;
        $this->confirmDeletePurchase = true;
    }

    // Delete purchase and rollback stock
    public function deletePurchaseData($id)
    {
        $purchase = Purchase::findOrFail($id);
        $menuItem = MenuItem::find($purchase->menu_item_id);

        $inventory = app(InventoryService::class);

        // Rollback stock: subtract the purchase quantity from stock (reverse of addPurchase)
        // We use adjustStock with negative quantity to reduce the stock
        $inventory->adjustStock($menuItem, - ((float)$purchase->quantity), 'Purchase deletion rollback');

        $purchase->delete();

        $this->confirmDeletePurchase = false;
        $this->deletePurchase = null;

        $this->alert('success', __('messages.purchaseDeleted') ?? 'Purchase deleted and stock rolled back', [
            'toast' => true,
            'position' => 'top-end',
        ]);

        $this->emit('purchaseAdded'); // refresh lists
    }

    public function clearFilters()
    {
        $this->filterCategories = [];
        $this->filterPaymentMethods = [];
        $this->filterStartDate = '';
        $this->filterEndDate = '';
        $this->search = '';
        $this->dispatch('clearPurchaseFilter');
    }

    public function render()
    {
        $query = Purchase::query()->where('branch_id', branch()->id);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('reference', 'like', '%' . $this->search . '%')
                    ->orWhere('notes', 'like', '%' . $this->search . '%');
            });
            $this->clearFilterButton = true;
        }

        $purchases = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.purchases.purchase-list', ['purchases' => $purchases]);
    }
}
