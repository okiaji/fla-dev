<?php

namespace App\FLA\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Log::debug('asdasdasdas');
        Blade::directive('authorize', function ($expression) {
            return "<?php if(CoreHelpers::authTask($expression)) { ?>";
        });

        Blade::directive('endauthorize', function ($expression) {
            return "<?php } ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}