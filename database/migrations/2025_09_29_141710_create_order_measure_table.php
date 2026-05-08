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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->string('mainmeasure');
            $table->string('submeasure')->nullable();
            $table->timestamps();
            $table->unique(['branch_id', 'mainmeasure', 'submeasure']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
