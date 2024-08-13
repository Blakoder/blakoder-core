<?php

namespace Blakoder\Core\Tests;

use Blakoder\Core\Contracts\Blakoder;
use Blakoder\Core\CoreServiceProvider;
use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use InteractsWithPublishedFiles;

    /** @var Blakoder This was added only to help IDE auto-completion */
    protected $blakoder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blakoder = $this->app->make('blakoder');
        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'Blakoder\\Core\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
    }

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_core_table.php.stub';
        $migration->up();
        */
    }
}
