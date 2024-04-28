<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\User;
use App\Observers\DepartmentObserver;
use App\Observers\UserObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        User        ::observe(UserObserver::class);
        Department  ::observe(DepartmentObserver::class);
    }
}
