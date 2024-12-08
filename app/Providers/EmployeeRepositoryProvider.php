<?php

namespace App\Providers;

use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\MySqlEmployeeRepository;
use App\Repositories\MsSqlEmployeeRepository;
use Illuminate\Support\ServiceProvider;

class EmployeeRepositoryProvider extends ServiceProvider
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
        if(1 == 1) {
            $this->app->bind(EmployeeRepositoryInterface::class, MySqlEmployeeRepository::class);
        } else {
            $this->app->bind(EmployeeRepositoryInterface::class, MsSqlEmployeeRepository::class);
        }
    }
}
