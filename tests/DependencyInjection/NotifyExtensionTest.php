<?php

namespace DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Yoeunes\Notify\Symfony\DependencyInjection\NotifyExtension;
use Yoeunes\Notify\Symfony\NotifyBundle;

class NotifyExtensionTest extends TestCase
{
    public function testContainContainNotifyService()
    {
        $container = $this->getRawContainer();
        $container->loadFromExtension('notify', array());
        $container->compile();

        $this->assertTrue($container->has('notify'));
    }

    public function test_notify_manager_get_config()
    {
        $container = $this->getRawContainer();
        $container->loadFromExtension('notify', array('default' => 'default_notifier', 'notifiers' => array(
            'default_notifier' => array(
                'scripts' => array('jquery.js', 'notify.js'),
                'styles' => array('bootstrap.css', 'notify.css'),
                'options' => array()
            )
        )));
        $container->compile();

        $definition = $container->getDefinition('notify');
        $config = $definition->getArgument(0);

        $this->assertInstanceOf('Yoeunes\Notify\Config\ConfigInterface', $config);
    }

    protected function getRawContainer()
    {
        $container = new ContainerBuilder();
//        $container->setParameter('kernel.debug', false);

        $extension = new NotifyExtension();
        $container->registerExtension($extension);

        $bundle = new NotifyBundle();
        $bundle->build($container);

        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->getCompilerPassConfig()->setAfterRemovingPasses(array());

        return $container;
    }

    protected function getContainer()
    {
        $container = $this->getRawContainer();
        $container->compile();

        return $container;
    }
}
