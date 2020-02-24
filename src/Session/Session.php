<?php

namespace Yoeunes\Notify\Symfony\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface as SymfonySessionInterface;
use Yoeunes\Notify\Session\SessionInterface;

class Session implements SessionInterface
{
    private $session;

    public function __construct(SymfonySessionInterface $session)
    {
        $this->session = $session;
    }

    public function get($key, $default = null)
    {
        return $this->session->get($key, $default);
    }

    public function flash($key, $value)
    {
        return $this->session->flash($key, $value);
    }
}
