<?php

namespace App\Providers;

use App\Rules\NotInPast;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
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

        Validator::extend('not_in_past', function ($attribute, $value, $parameters, $validator) {
            return (new NotInPast)->passes($attribute, $value);
        });
    }
}
