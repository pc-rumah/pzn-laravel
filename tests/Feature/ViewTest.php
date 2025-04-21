<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_View()
    {
        $this->get('/hello')
            ->assertSeeText('hello ahmad');
    }

    public function testNestedView()
    {
        $this->get('/helloworld')
            ->assertSeeText('world ahmad');
    }

    public function testViewWithOutRoute()
    {
        $this->view('hello', ['name' => 'ahmad'])
            ->assertSeeText('hello ahmad');

        $this->view('hello.world', ['name' => 'ahmad'])
            ->assertSeeText('world ahmad');
    }
}
