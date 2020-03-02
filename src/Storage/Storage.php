<?php

namespace Yoeunes\Notify\Symfony\Storage;

use Symfony\Component\HttpFoundation\Session\Session;
use Yoeunes\Notify\Storage\StorageInterface;

final class Storage implements StorageInterface
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function get($key, $default = array())
    {
        return $this->session->getFlashBag()->get($key, $default);
    }

    public function flash($key, $value)
    {
        return $this->session->getFlashBag()->add($key, $value);
    }
}
