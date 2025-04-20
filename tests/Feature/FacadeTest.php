<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertSame($firstName, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDepedency()
    {

        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertSame($firstName, $firstName2);
        self::assertSame($firstName, $firstName3);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Ahmad Keren');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Ahmad Keren', $firstName);
    }
}
