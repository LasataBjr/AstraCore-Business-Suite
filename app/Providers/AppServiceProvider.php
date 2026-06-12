<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings safely with all Blade views globally
        if (!app()->runningInConsole() && Schema::hasTable('site_settings')) {
            View::share('setting', SiteSetting::first() ?? new SiteSetting());
        }

        // FORCE TAILWIND STYLING ON PAGINATION LINKS (e.g., $messages->links())
        Paginator::useTailwind();
    }
}
