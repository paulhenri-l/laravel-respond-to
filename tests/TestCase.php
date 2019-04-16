<?php

namespace PHL\LaravelRespondTo\Tests;

use PHL\LaravelRespondTo\Tests\Fakes\FakeAppServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Load the fake app service provider.
     */
    protected function getPackageProviders($app)
    {
        return [FakeAppServiceProvider::class];
    }
}
