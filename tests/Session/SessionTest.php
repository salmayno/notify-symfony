<?php

namespace Yoeunes\Notify\Symfony\Tests\Session;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Yoeunes\Notify\Symfony\Session\Session;

class SessionTest extends TestCase
{
    public function test_session_flash()
    {
        $this->markTestIncomplete();

        $session = new Session(new SymfonySession(new MockArraySessionStorage()));

        $notifications = array(
            array('type' => 'success', 'title' => 'success title'),
            array('type' => 'info', 'title' => 'success info'),
        );

        $session->flash('notifications', $notifications);
        $this->assertEquals($notifications, $session->get('notifications'));
    }
}
