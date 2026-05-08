<?php

namespace App\Providers;

use App\Enums\PackageType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('planIsActive', function ($user) {
            switch (restaurant()->package->package_type) {
                case PackageType::TRIAL:
                    $daysLeftInTrial = floor(now(timezone())->diffInDays(Carbon::parse(restaurant()->trial_ends_at)->addDays(1)));
                    return $daysLeftInTrial > 0;
                case PackageType::DEFAULT:
                case PackageType::FREE:
                    return false;
                case PackageType::LIFETIME:
                case PackageType::STANDARD:
                    return true;
            }
        });
    }
}
