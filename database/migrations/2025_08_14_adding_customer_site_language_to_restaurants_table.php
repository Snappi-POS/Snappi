<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if column does not exist before adding
        if (!Schema::hasColumn('restaurants', 'customer_site_language')) {
            Schema::table('restaurants', function (Blueprint $table) {
                $table->string('customer_site_language')->nullable()->after('about_us');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('restaurants', 'customer_site_language')) {
            Schema::table('restaurants', function (Blueprint $table) {
                $table->dropColumn('customer_site_language');
            });
        }
    }
};
