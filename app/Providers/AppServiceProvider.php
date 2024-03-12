<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Blade::directive('ratingStars', function ($rating) {
            return "<?php echo str_repeat('<i class=\"bx bxs-star custom-star\"></i>', $rating); ?>";
        });
    }
}
