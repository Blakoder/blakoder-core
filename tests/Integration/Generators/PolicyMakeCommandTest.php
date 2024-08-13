<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class PolicyMakeCommandTest extends TestCase
{
    protected $files = [
        'app/Policies/FooPolicy.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:policy', ['name' => 'FooPolicy', '--model' => 'Foo'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Policies;',
            'class FooPolicy',
        ], 'app/Policies/FooPolicy.php');
    }
}
