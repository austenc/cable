<?php

namespace AustenCam\Preset\Providers;

use AustenCam\Preset\Commands\RadCommand;
use Illuminate\Support\ServiceProvider;

class RadProvider extends ServiceProvider
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
                RadCommand::class,
            ]);
        }
    }
}
