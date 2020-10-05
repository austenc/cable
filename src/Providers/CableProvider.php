<?php

namespace AustenCam\Cable\Providers;

use AustenCam\Cable\Commands\CableCommand;
use Illuminate\Support\ServiceProvider;

class CableProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CableCommand::class,
            ]);
        }
    }
}
