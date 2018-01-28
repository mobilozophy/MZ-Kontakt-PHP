<?php

namespace Mobilozophy\Kontakt;

use Illuminate\Support\ServiceProvider;

class MZKontaktServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (function_exists('config_path'))
        {
            $this->publishes([
                __DIR__.'config/config.php' => config_path('kontakt.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    public function provides()
    {
        return [
            
        ];
    }
}
