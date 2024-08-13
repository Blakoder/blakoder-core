<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class RepositoryInterfaceMakeCommandTest extends TestCase
{
    protected $files = [
        'app/Repositories/Foo/FooRepositoryInterface.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:repositoryinterface', ['name' => 'FooRepositoryInterface', '--model' => 'Foo'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Repositories\Foo;',
            'use Blakoder\Core\Repositories\BaseRepositoryInterface;',
            'interface FooRepositoryInterface extends BaseRepositoryInterface',
        ], 'app/Repositories/Foo/FooRepositoryInterface.php');
    }
}
