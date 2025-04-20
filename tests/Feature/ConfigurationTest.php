<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testConfig(): void
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $no = config('contoh.no');

        self::assertEquals('Ahmad', $firstName);
        self::assertEquals('ismail', $lastName);
        self::assertEquals('ahmadismail@gmail.com', $email);
        self::assertEquals('08888', $no);
    }
}
