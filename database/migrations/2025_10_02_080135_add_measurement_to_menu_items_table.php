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
        Schema::table('menu_items', function (Blueprint $table) {
             $table->foreignId('measurement_id')
                ->nullable()
                ->constrained('measurements')
                ->onDelete('set null');
            $table->unsignedInteger('quantity_in_measure')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['measurement_id']);
            $table->dropColumn(['measurement_id', 'quantity_in_measure']);
        });
    }
};
