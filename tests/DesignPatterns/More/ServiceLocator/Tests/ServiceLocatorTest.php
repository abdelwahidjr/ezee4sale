<?php

namespace Tests\DesignPatterns\More\ServiceLocator\Tests;

use PHPUnit\Framework\TestCase;
use Tests\DesignPatterns\More\ServiceLocator\LogService;
use Tests\DesignPatterns\More\ServiceLocator\ServiceLocator;

class ServiceLocatorTest extends TestCase
{
    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    public function setUp()
    {
        $this->serviceLocator = new ServiceLocator();
    }

    public function testHasServices()
    {
        $this->serviceLocator->addInstance(LogService::class , new LogService());

        $this->assertTrue($this->serviceLocator->has(LogService::class));
        $this->assertFalse($this->serviceLocator->has(self::class));
    }

    public function testGetWillInstantiateLogServiceIfNoInstanceHasBeenCreatedYet()
    {
        $this->serviceLocator->addClass(LogService::class , []);
        $logger = $this->serviceLocator->get(LogService::class);

        $this->assertInstanceOf(LogService::class , $logger);
    }
}
