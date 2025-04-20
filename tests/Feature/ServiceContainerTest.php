<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testDepedency()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        //$person = $this->app->make(Person::class); //new person
        //self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new person("Ahmad", "Ismail");
        });

        $person1 = $this->app->make(Person::class); // closure() // new person("Ahmad", "Ismail");
        $person2 = $this->app->make(Person::class); // closure() // new person("Ahmad", "Ismail");

        self::assertEquals("Ahmad", $person1->firstname);
        self::assertEquals("Ismail", $person2->lastname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new person("Ahmad", "Ismail");
        });

        $person1 = $this->app->make(Person::class); // new person("Ahmad", "Ismail"); if not exists
        $person2 = $this->app->make(Person::class); //return existing

        self::assertEquals("Ahmad", $person1->firstname);
        self::assertEquals("Ismail", $person2->lastname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Ahmad", "Ismail");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals("Ahmad", $person1->firstname);
        self::assertEquals("Ismail", $person2->lastname);
        self::assertSame($person1, $person2);
    }

    public function testDepedencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService  = $this->app->make(HelloService::class);

        self::assertEquals('Halo Ahmad', $helloService->hello('Ahmad'));
    }
}
