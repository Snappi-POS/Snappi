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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->index(); // keep same branch_id pattern
            $table->foreignId('menu_item_id')->constrained('menu_items')->onDelete('cascade');
            $table->unsignedBigInteger('quantity')->default(0); // stored in smallest unit (submeasure units)
            $table->timestamps();

            $table->unique(['branch_id', 'menu_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
