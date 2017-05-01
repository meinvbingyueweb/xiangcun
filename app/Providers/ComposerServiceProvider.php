<?php namespace App\Providers;

use App\Http\ViewComposers\ProfileComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*view()->composers([
            ProfileComposer::class => [
                'pc.category.*',
            ]
        ]);

        view()->composer(
            'pc.category.*', ProfileComposer::class
        );

        view()->composer('dashboard', function ($view) {

        });*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
