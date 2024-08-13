<?php

namespace Blakoder\Core\Tests\Integration\Generators;

class LangMakeCommandTest extends TestCase
{
    protected $files = [
        'resources/lang/es/foos.php',
    ];

    public function testItCanGenerateRequestFile()
    {
        $this->artisan('blakoder:make:lang', ['name' => 'foo', '--model' => 'Foo', '--lang' => 'es'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'add' => 'Agregar foo',
        ], 'resources/lang/es/foos.php');
    }
}
