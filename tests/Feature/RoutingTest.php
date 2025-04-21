<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('pzn');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            // ->assertStatus(404)
            ->assertSeeText('404 by pzn');
    }

    public function testRouteParameter()
    {
        $this->get('/product/1')
            ->assertSeeText('Product 1');

        $this->get('/product/2')
            ->assertSeeText('Product 2');

        $this->get('/product/2/items/buku')
            ->assertSeeText('Product 2, Item buku');
    }

    public function testRegularExpression()
    {
        $this->get('/category/12345')
            ->assertSeeText("category : 12345");

        $this->get('/category/salah')
            ->assertSeeText("404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');

        $this->get('/conflict/ahmad')
            ->assertSeeText('Conflict ahmad');
    }

    public function testNamedRoute()
    {
        $this->get('/product/12345')
            ->assertSeeText('product/12345');

        $this->get('/product-redirect/12345')
            ->assertSeeText('product-redirect/12345');
    }
}
