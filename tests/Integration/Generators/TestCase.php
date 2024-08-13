<?php

namespace Blakoder\Core\Tests\Integration\Generators;

use Blakoder\Core\CoreServiceProvider;
use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithPublishedFiles;

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
        ];
    }
}
