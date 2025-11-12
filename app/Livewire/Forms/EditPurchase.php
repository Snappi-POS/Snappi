<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\MenuItem;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class EditPurchase extends Component
{
    public $purchaseId;

    public $item_id;
    public $quantity;
    public $measurement_select;
    public $price;
    public $purchase_date;
    public $description;

    public $measurements = [];
    public $products = [];

    protected $rules = [
        'item_id' => 'required|exists:menu_items,id',
        'quantity' => 'required|numeric|min:1',
        'measurement_select' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'purchase_date' => 'required|date',
        'description' => 'nullable|string|max:500',
    ];

    public function mount($purchaseId = null)
    {
        $this->products = MenuItem::where('branch_id', branch()->id)->get();

        if ($purchaseId) {
            $this->loadPurchase($purchaseId); // ✅ load immediately when mounted
        }
    }

    // public function loadPurchase($id)
    // {
    //     $purchase = Purchase::with('menuItem.measurement')->findOrFail($id);

    //     $this->purchaseId = $purchase->id;
    //     $this->item_id = $purchase->menu_item_id;
    //     $this->quantity = $purchase->quantity;
    //     $this->price = $purchase->price;
    //     $this->purchase_date = $purchase->purchase_date ;
    //     $this->description = $purchase->notes;

    //     $this->updateMeasurementField($this->item_id);
    //     $this->measurement_select = $purchase->menuItem->measurement->mainmeasure ?? null;
    // }

    public function loadPurchase($id)
{
    $purchase = Purchase::with('menuItem.measurement')->findOrFail($id);

    $this->purchaseId = $purchase->id;
    $this->item_id = $purchase->menu_item_id;
    $this->quantity = $purchase->quantity;
    $this->price = $purchase->price;
    $this->purchase_date = $purchase->purchase_date;
    $this->description = $purchase->notes;

    // Load measurement info for selected item
    $this->updateMeasurementField($this->item_id);

    // ✅ Auto-select submeasure if available, otherwise mainmeasure
    $measurement = $purchase->menuItem->measurement ?? null;
    if ($measurement) {
        $this->measurement_select = $measurement->submeasure ?: $measurement->mainmeasure;
    } else {
        $this->measurement_select = null;
    }
}


    public function updateMeasurementField($menuItemId)
    {
        $menuItem = MenuItem::with('measurement')->find($menuItemId);

        if ($menuItem && $menuItem->measurement) {
            $this->measurements = [
                'main' => $menuItem->measurement->mainmeasure,
                'sub' => $menuItem->measurement->submeasure,
            ];
        } else {
            $this->measurements = [];
        }
    }

    public function updateMeasurementSelect($value)
    {
        $this->measurement_select = $value;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $purchase = Purchase::findOrFail($this->purchaseId);
            $purchase->update([
                'menu_item_id' => $this->item_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'purchase_date' => $this->purchase_date,
                'notes' => $this->description,
            ]);
        });

        $this->dispatch('purchaseUpdated');
        $this->dispatch('hideEditPurchases');
        $this->dispatch('notify', type: 'success', message: __('Purchase updated successfully!'));
    }

    public function render()
    {
        return view('livewire.forms.edit-purchase');
    }
}
