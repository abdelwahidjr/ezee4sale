<?php

namespace Tests\DesignPatterns\Behavioral\Observer\Tests;

use PHPUnit\Framework\TestCase;
use Tests\DesignPatterns\Behavioral\Observer\User;
use Tests\DesignPatterns\Behavioral\Observer\UserObserver;

class ObserverTest extends TestCase
{
    public function testChangeInUserLeadsToUserObserverBeingNotified()
    {
        $observer = new UserObserver();

        $user = new User();
        $user->attach($observer);

        $user->changeEmail('foo@bar.com');
        $this->assertCount(1 , $observer->getChangedUsers());
    }
}
