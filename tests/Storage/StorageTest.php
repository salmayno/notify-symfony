<?php

namespace Yoeunes\Notify\Symfony\Tests\Storage;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Yoeunes\Notify\Symfony\Storage\Storage;

class StorageTest extends TestCase
{
    public function test_session_flash()
    {
        $session = new Storage(new Session(new MockArraySessionStorage()));

        $session->flash('notifications', array('type' => 'success', 'title' => 'success title'));
        $this->assertEquals(array('type' => 'success', 'title' => 'success title'), $session->get('notifications'));

        $session->flash('notifications', array('type' => 'info', 'title' => 'info title'));
        $this->assertEquals(array('type' => 'info', 'title' => 'info title'), $session->get('notifications'));

        $this->assertEquals(array(), $session->get('notifications'));
    }
}
