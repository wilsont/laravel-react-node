<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\React;

class ReactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(React\React::class);
        $this->app->alias(React\React::class, 'app.react');
    }

    public function boot()
    {
        Blade::directive('react', function ($expr) {
            return "<?php echo app('app.react')->render$expr; ?>";
        });
    }
}
