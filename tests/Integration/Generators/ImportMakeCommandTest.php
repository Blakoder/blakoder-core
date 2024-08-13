<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class ImportMakeCommandTest extends TestCase
{
    protected $files = [
        'app/Imports/FooImport.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:import', ['name' => 'FooImport', '--model' => 'Foo'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Imports;',
            'class FooImport implements ToModel, WithChunkReading, ShouldQueue, WithEvents',
        ], 'app/Imports/FooImport.php');
    }
}
