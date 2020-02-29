<?php

namespace Yoeunes\Notify\Symfony\Session;

use Yoeunes\Notify\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySessionInterface;

final class Session implements SessionInterface
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
        return $this->session->getFlashBag()->add($key, $value);
    }
}
