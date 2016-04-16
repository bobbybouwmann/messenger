<?php

namespace Bobbybouwmann\Messenger;

use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->isLumen()) {
            $configPath = __DIR__.'/../config/messenger.php';

            $this->publishes([
                $configPath => config_path('messenger.php')
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $path = __DIR__ . '/../config/messenger.php';
        $this->mergeConfigFrom($path, 'messenger');

        $this->app->bind(Messenger::class, function ($app) {
            return new Messenger($app['config']);
        });
    }

    /**
     * Check if package is running under Lumen app
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}