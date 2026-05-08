<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->index();
            $table->foreignId('menu_item_id')->constrained('menu_items')->onDelete('cascade');
            $table->foreignId('measurement_id')->nullable()->constrained('measurements')->nullOnDelete();
            $table->bigInteger('quantity_change'); // signed: + incoming, - outgoing (in smallest units)
            $table->string('type', 50)->default('adjustment'); // purchase, sale, adjustment, consumption, transfer...
            $table->unsignedBigInteger('reference_id')->nullable(); // optional link to purchase/order/id
            $table->string('reference_type')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['menu_item_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
