<?php

namespace Util\Auth;

use Illuminate\Support\ServiceProvider;
use Util\Network\Api;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Api::setAuthResolver($this->app['Util\Auth\Contract']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $auth = ucfirst(strtolower($this->app['config']['fanfou']['auth_mode']));
        $this->app->bind('Util\Auth\Contract', "Util\Auth\\{$auth}");
    }
}
