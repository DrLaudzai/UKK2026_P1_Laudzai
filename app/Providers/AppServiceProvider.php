<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tool;
use App\Models\Category;
use App\Models\User;
use App\Models\ToolUnit;
use App\Observers\GlobalObserver;

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
        Tool::observe(GlobalObserver::class);
        Category::observe(GlobalObserver::class);
        User::observe(GlobalObserver::class);
        ToolUnit::observe(GlobalObserver::class);
    }
}
