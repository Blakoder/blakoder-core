<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class ExportMakeCommandTest extends TestCase
{
    protected $files = [
        'app/Exports/FooExport.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:export', ['name' => 'FooExport', '--model' => 'Foo'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Exports;',
            'class FooExport implements FromCollection, WithMapping, WithHeadings',
        ], 'app/Exports/FooExport.php');
    }
}
