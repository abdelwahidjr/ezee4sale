<?php

namespace Tests\DesignPatterns\Creational\SimpleFactory;

class SimpleFactory
{
    public function createBicycle() : Bicycle
    {
        return new Bicycle();
    }
}
