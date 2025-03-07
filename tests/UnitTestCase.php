<?php

declare(strict_types=1);

namespace Oltrematica\RateLimiter\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Oltrematica\RateLimiter\ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class UnitTestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName): string => 'Oltrematica\\RateLimiter\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        //        config()->set('oltrematica-RateLimiter.prefix', 'custom-prefix');
        //        config()->set('oltrematica-RateLimiter.protected', true);

        /*
        $migration = include __DIR__.'/../database/migrations/create_RateLimiter_table.php.stub';
        $migration->up();
        */
    }

    protected function getPackageProviders($app)
    {
        return [
            //            ServiceProvider::class,
        ];
    }
}
