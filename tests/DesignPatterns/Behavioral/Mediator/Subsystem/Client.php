<?php

namespace Tests\DesignPatterns\Behavioral\Mediator\Subsystem;

use Tests\DesignPatterns\Behavioral\Mediator\Colleague;

/**
 * Client is a client that makes requests and gets the response.
 */
class Client extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }

    public function output(string $content)
    {
        echo $content;
    }
}
