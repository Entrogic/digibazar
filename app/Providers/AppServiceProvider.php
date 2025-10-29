<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Register BDT currency formatting helper
        Blade::directive('bdt', function ($expression) {
            return "<?php echo '৳' . number_format($expression, 2); ?>";
        });
    }
}
