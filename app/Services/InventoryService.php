<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    /**
     * Record a generic stock movement
     */
    public function recordMovement(
        MenuItem $menuItem,
        float $quantityChange,
        string $type,
        ?int $referenceId = null,
        ?string $referenceType = null,
        ?string $notes = null
    ) {
        DB::transaction(function () use ($menuItem, $quantityChange, $type, $referenceId, $referenceType, $notes) {

            // Create StockMovement
            StockMovement::create([
                'branch_id'       => $menuItem->branch_id,
                'menu_item_id'    => $menuItem->id,
                'measurement_id'  => $menuItem->measurement_id,
                'quantity_change' => $quantityChange,
                'type'            => $type,
                'reference_id'    => $referenceId,
                'reference_type'  => $referenceType,
                'notes'           => $notes,
            ]);

            // Update stock table
            $stock = Stock::firstOrCreate(
                ['branch_id' => $menuItem->branch_id, 'menu_item_id' => $menuItem->id],
                ['quantity' => 0]
            );

            $tr = $stock->quantity + $quantityChange;
             if ($tr > -1) {
                $stock->quantity += $quantityChange;
            }else{
                $stock->quantity = 0;
            }
            $stock->save();
        });
    }

    /**
     * Add stock from a purchase
     */
    public function addPurchase(MenuItem $menuItem, float $quantity, int $purchaseId)
    {
        return $this->recordMovement(
            $menuItem,
            $quantity,
            'purchase',
            $purchaseId,
            'purchase',
            'Added from purchase'
        );
    }

    public function cancelPurchase(MenuItem $menuItem, float $quantity)
    {
        return $this->recordMovement(
            $menuItem,
            -$quantity,
            'canceledpurchase',
            null,
            null,
            'Canceled a purchase'
        );
    }


    /**
     * Adjust stock manually
     */
    public function adjustStock(MenuItem $menuItem, float $quantityChange, ?string $notes = null)
    {
        return $this->recordMovement(
            $menuItem,
            $quantityChange,
            'adjustment',
            null,
            null,
            $notes ?? 'Manual stock adjustment'
        );
    }

    /**
     * New stock 
     */
    public function addNewStock(MenuItem $menuItem, float $quantityChange, ?string $notes = null)
    {
        return $this->recordMovement(
            $menuItem,
            $quantityChange,
            'newstock',
            null,
            null,
            $notes ?? 'Created new stock adjustment'
        );
    }

    /**
     * Deduct stock when a sale occurs
     */
    public function deductSale(MenuItem $menuItem, float $quantity, int $orderId)
    {
        return $this->recordMovement(
            $menuItem,
            -$quantity,  // negative for deduction
            'sale',
            $orderId,
            'order',
            'Deducted for sale'
        );
    }

    /**
     * Rollback stock when an order is canceled
     */
    public function rollbackSale(MenuItem $menuItem, float $quantity, int $orderId)
    {
        return $this->recordMovement(
            $menuItem,
            $quantity,  // positive to restore stock
            'rollback',
            $orderId,
            'order',
            'Stock restored due to order cancellation'
        );
    }

    /**
     * Check if a sale can be fulfilled
     */
    public function canFulfillSale(MenuItem $menuItem, float $quantity): bool
    {
        $currentStock = $menuItem->current_stock; // Uses your stock relation
        return $currentStock >= $quantity;
    }
}
