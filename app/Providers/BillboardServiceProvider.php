<?php

namespace App\Providers;

use App\Repository\BillboardRepository;
use App\Repository\Repository;
use App\Services\BillboardServices;
use App\Services\Services;
use Illuminate\Support\ServiceProvider;

class BillboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Repository::class, BillboardRepository::class);
        $this->app->bind(Services::class, BillboardServices::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
