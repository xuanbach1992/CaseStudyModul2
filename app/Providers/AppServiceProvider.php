<?php

namespace App\Providers;

use App\Repository\eloquent\ProductRepository;
use App\Repository\ProductRepositoryInterface;
use App\Service\implement\ProductService;
use App\Service\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(ProductServiceInterface::class,ProductService::class);
      $this->app->singleton(ProductRepositoryInterface::class,ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
