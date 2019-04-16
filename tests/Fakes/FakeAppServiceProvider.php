<?php

namespace PHL\LaravelRespondTo\Tests\Fakes;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FakeAppServiceProvider extends ServiceProvider
{
    /**
     * Boot the fake app.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'FakeApp');

        Route::namespace('PHL\LaravelRespondTo\Tests\Fakes\Controllers')
            ->group(function ($router) {
                $router->get('/', 'HomeController@index');
                $router->get('/no-response', 'NoResponseController@index');
                $router->get('/no-with', 'NoWithController@index');
                $router->get('/default-format', 'RespondWithDefaultController@index');
                $router->get('/custom-format', 'RespondWithCustomDefaultController@index');
            });
    }
}
