<?php

namespace App\Models;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Purchase extends Model
{
    protected $fillable = [
        'branch_id',
        'menu_item_id',
        'quantity',
        'price',
        'reference',
        'notes',
        'purchase_date',
    ];
    //protected $with = ['menuitem'];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

   


public function getFormattedQuantityAttribute()
{
    // Ensure we have a related menuItem
    if (!$this->menuItem) {
        return $this->quantity;
    }

    $menuItem = $this->menuItem;
    $measurement = $menuItem->measurement; // relationship to measurements table

    // If no measurement found, fallback
    if (!$measurement) {
        return $this->quantity;
    }

    $quantityInMeasure = $menuItem->quantity_in_measure ?? 0;

    // Case 1: No submeasure or no quantity_in_measure
    if (empty($measurement->submeasure) || $quantityInMeasure <= 0) {
        return $this->quantity . ' ' . Str::plural($measurement->mainmeasure, $this->quantity);
    }

    // Case 2: Split into main + submeasure
    $mainCount = intdiv($this->quantity, $quantityInMeasure);
    $subCount = $this->quantity % $quantityInMeasure;

    $parts = [];

    if ($mainCount > 0) {
        $parts[] = $mainCount . ' ' . Str::plural($measurement->mainmeasure, $mainCount);
    }

    if ($subCount > 0) {
        $parts[] = $subCount . ' ' . Str::plural($measurement->submeasure, $subCount);
    }

    return implode(' ', $parts);
}


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
