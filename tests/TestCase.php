<?php

namespace Arpanpatoliya\Response\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Arpanpatoliya\Response\Providers\ResponseServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            ResponseServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     */
    protected function defineEnvironment($app): void
    {
        // Define any environment variables or configurations here
    }
} 