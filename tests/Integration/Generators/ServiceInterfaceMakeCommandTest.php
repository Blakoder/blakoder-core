<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class ServiceInterfaceMakeCommandTest extends TestCase
{
    protected $files = [
        'app/Services/Foo/FooServiceInterface.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:serviceinterface', ['name' => 'FooServiceInterface', '--model' => 'Foo'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Services\Foo;',
            'use Blakoder\Core\Services\BaseServiceInterface;',
            'interface FooServiceInterface extends BaseServiceInterface',
        ], 'app/Services/Foo/FooServiceInterface.php');
    }
}
