<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'menu_item_id',
        'measurement_id',
        'quantity_change',
        'type',
        'reference_id',
        'reference_type',
        'notes',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }
}
