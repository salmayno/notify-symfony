<?php

namespace Yoeunes\Notify\Symfony\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;
use Yoeunes\Notify\Symfony\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    public function test_default_config()
    {
        $config = $this->process(array());

        $this->assertArrayHasKey('default', $config);
        $this->assertArrayHasKey('notifiers', $config);
    }

    public function test_simple_config()
    {
        $config = $this->process(array(array(
            'default' => 'tailwind',
            'notifiers' => array(
                'tailwind' => array(
                    'notifier' => 'nice',
                    'scripts' => array('jquery.js'),
                ),
            ),
        )));

        $this->assertEquals('tailwind', $config['default']);
        $this->assertEquals('jquery.js', $config['notifiers']['tailwind']['scripts'][0]);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage The path "notify.default" cannot contain an empty value, but got "".
     */
    public function test_empty_default_notifier()
    {
        $this->process(array(array('default' => '')));
    }

    /**
     * Processes an array of configurations and returns a compiled version.
     *
     * @param array $configs An array of raw configurations
     *
     * @return array A normalized array
     */
    private function process($configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $configs);
    }
}
