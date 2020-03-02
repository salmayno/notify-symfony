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
        $session->flash('notifications', array('type' => 'info', 'title' => 'success info'));

        $this->assertEquals(
            array(
                array('type' => 'success', 'title' => 'success title'),
                array('type' => 'info', 'title' => 'success info'),
            ),
            $session->get('notifications')
        );
    }
}
