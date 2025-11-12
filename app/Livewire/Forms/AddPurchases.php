<?php

namespace App\Livewire\Forms;

use App\Helper\Files;
use App\Models\Purchase;
use App\Services\InventoryService;
use App\Models\MenuItem;
use App\Models\Measurement;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AddPurchases extends Component
{
    use WithFileUploads, LivewireAlert;

    // --- Form Fields ---
    public $item_id;
    public $quantity;
    public $main_quantity;
    public $measurement_select;
    public $price;
    public $purchase_date;
    public $description;

    // --- Auto-loaded data ---
    public $measurements = []; // will hold main/sub measures for selected product
    public $quantity_in_measure = 1; // from menu_items table

    public $showPurchaseItemModal = false;

    // --- Livewire Events ---
    protected $listeners = [
        'closeModal',
    ];

    #[On('hidePurchaseCategoryModal')]
    public function hidePurchaseCategoryModal()
    {
        $this->showPurchaseItemModal = false;
    }

    // --- Watch when a product is selected ---
    

    public function updateMeasurementField($value)
    {
        $this->item_id = $value;
        // $this->measurement_select = '';
        $this->measurements = [];
        $this->main_quantity = 0;
        $this->quantity_in_measure = 1;

        if (!$value) return;

        $menuItem = MenuItem::find($value);

        $measurement = Measurement::where('id', $menuItem->measurement_id)->first();

        if ($measurement) {
            $this->measurements = [
                'main' => $measurement->mainmeasure,
                'sub'  => $measurement->submeasure,
            ];
        }

        if ($menuItem && $menuItem->quantity_in_measure) {
            $this->quantity_in_measure = $menuItem->quantity_in_measure;
        }
    }

    public function updateMeasurementSelect($value)
    {
        if (!$this->quantity || !$this->item_id) {
            return;
        }

        if ($value === $this->measurements['main'] &&  $this->measurements['sub'] !=null) {
            $this->main_quantity = $this->quantity * $this->quantity_in_measure;
        }else{
            $this->main_quantity = $this->quantity;
        }
    }

    public function save()
    {
        $menuItem = MenuItem::find($this->item_id);
        $inventory = app(InventoryService::class);

        $this->validate([
            'item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|numeric|min:1',
            'measurement_select' => 'required|string',
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

      $purchase = Purchase::create([
            'menu_item_id' => $this->item_id,
            'quantity' => $this->main_quantity,
            'price' => $this->price,
            'purchase_date' => $this->purchase_date,
            'notes' => $this->description,
            'branch_id' => branch()->id, 
        ]);
     
      $inventory -> addPurchase($menuItem, $this->main_quantity,  $purchase->id);

        $this->reset(['item_id', 'quantity', 'measurement_select', 'price', 'purchase_date', 'description', 'measurements']);

        $this->alert('success', __('Purchase saved successfully'), [
            'toast' => true,
            'position' => 'top-end',
        ]);

        $this->dispatch('purchaseAdded');
    }

    public function render()
    {
        return view('livewire.forms.add-purchases', [
            'products' => MenuItem::orderBy('item_name')->get(),
        ]);
    }
}
