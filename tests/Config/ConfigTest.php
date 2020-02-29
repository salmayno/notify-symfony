<?php

namespace Yoeunes\Notify\Symfony\Tests\Config;

use PHPUnit\Framework\TestCase;
use Yoeunes\Notify\Symfony\Config\Config;

class ConfigTest extends TestCase
{
    private static $configuration = array(
        'default' => 'default_notifier',
        'notifiers' => array(
            'default_notifier' => array(
                'scripts' => array('jquery.js', 'notifier.js'),
                'styles' => array('notifier.css'),
                'options' => array(
                    'css_classes' => array(
                        'success' => 'primary',
                    ),
                ),
            ),
        ),
    );

    public function test_simple_get()
    {
        $config = new Config(self::$configuration);
        $this->assertEquals('default_notifier', $config->get('default'));
    }

    public function test_get_nested_values()
    {
        $config = new Config(self::$configuration);

        $this->assertEquals(array('notifier.css'), $config->get('notifiers.default_notifier.styles'));
        $this->assertEquals('notifier.css', $config->get('notifiers.default_notifier.styles.0'));
    }

    public function test_default_value()
    {
        $config = new Config(self::$configuration);

        $this->assertEquals(null, $config->get('not_found'));
        $this->assertEquals('default_value', $config->get('not_found', 'default_value'));
    }
}
