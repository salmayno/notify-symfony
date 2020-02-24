<?php

namespace Yoeunes\Notify\Symfony\Config;

use Yoeunes\Notify\Config\ConfigInterface;

class Config implements ConfigInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function get($key, $default = null)
    {
        $data = $this->config;

        foreach (explode('.', $key) as $segment) {
            if (!isset($data[$segment])) {
                return $default;
            }

            $data = $data[$segment];
        }

        return $data;
    }
}
