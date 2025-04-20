<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppEnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAppEnv()
    {
        if (App::environment('testing')) {
            $this->assertTrue(true);
        };
    }
}
