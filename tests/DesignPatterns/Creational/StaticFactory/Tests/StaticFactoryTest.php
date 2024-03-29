<?php

namespace Tests\DesignPatterns\Creational\StaticFactory\Tests;

use PHPUnit\Framework\TestCase;
use Tests\DesignPatterns\Creational\StaticFactory\StaticFactory;

class StaticFactoryTest extends TestCase
{
    public function testCanCreateNumberFormatter()
    {
        $this->assertInstanceOf(
            'Tests\DesignPatterns\Creational\StaticFactory\FormatNumber' ,
            StaticFactory::factory('number')
        );
    }

    public function testCanCreateStringFormatter()
    {
        $this->assertInstanceOf(
            'Tests\DesignPatterns\Creational\StaticFactory\FormatString' ,
            StaticFactory::factory('string')
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testException()
    {
        StaticFactory::factory('object');
    }
}
