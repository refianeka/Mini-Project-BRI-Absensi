<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MiniProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/sidebarHelper.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
