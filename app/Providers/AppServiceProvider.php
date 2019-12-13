<?php

namespace App\Providers;

use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\PasswordServiceInterface;
use App\Services\CustomerService;
use App\Services\PasswordHashService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\AgentRepository;
use App\Repositories\Eloquent\CustomerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Repositories
         */
        $this->app->bind(AgentRepository::class);
        $this->app->bind(CustomerRepository::class);

        /*
         * Services
         */
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(PasswordServiceInterface::class, PasswordHashService::class);
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
