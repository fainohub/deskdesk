<?php

namespace App\Providers;


use App\Services\Contracts\TicketMessageServiceInterface;
use App\Services\TicketMessageService;
use Illuminate\Support\ServiceProvider;
use App\Services\TicketService;
use App\Services\CustomerService;
use App\Services\PasswordHashService;
use App\Services\Contracts\CustomerServiceInterface;
use App\Services\Contracts\PasswordServiceInterface;
use App\Services\Contracts\TicketServiceInterface;
use App\Repositories\Eloquent\AgentRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\TicketMessageRepository;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\Contracts\AgentRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\TicketMessageRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;


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
        $this->app->bind(AgentRepositoryInterface::class, AgentRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(TicketMessageRepositoryInterface::class, TicketMessageRepository::class);

        /*
         * Services
         */
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        $this->app->bind(PasswordServiceInterface::class, PasswordHashService::class);
        $this->app->bind(TicketMessageServiceInterface::class, TicketMessageService::class);
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
