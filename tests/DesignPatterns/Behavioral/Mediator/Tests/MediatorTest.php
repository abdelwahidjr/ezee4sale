<?php

namespace Tests\DesignPatterns\Tests\Mediator\Tests;

use PHPUnit\Framework\TestCase;
use Tests\DesignPatterns\Behavioral\Mediator\Mediator;
use Tests\DesignPatterns\Behavioral\Mediator\Subsystem\Client;
use Tests\DesignPatterns\Behavioral\Mediator\Subsystem\Database;
use Tests\DesignPatterns\Behavioral\Mediator\Subsystem\Server;

class MediatorTest extends TestCase
{
    public function testOutputHelloWorld()
    {
        $client = new Client();
        new Mediator(new Database() , $client , new Server());

        $this->expectOutputString('Hello World');
        $client->request();
    }
}
