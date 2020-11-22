<?php

namespace Notify\Symfony\Tests\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Notify\Symfony\DependencyInjection\NotifyExtension;
use Notify\Symfony\NotifyBundle;

final class NotifierCompilerPassTest extends TestCase
{
    public function test_process()
    {
        $container = $this->getContainer();

        $this->assertTrue($container->hasDefinition('test_notifier'));

        $notifier = $container->getDefinition('test_notifier');
        $this->assertTrue($notifier->hasTag('notify.notifier'));

        $manager = $container->getDefinition('notify');
        $calls = $manager->getMethodCalls();

        $this->assertCount(1, $calls);
        $this->assertEquals('extend', $calls[0][0]);
        $this->assertEquals('test_notifier', $calls[0][1][0]);
    }

    private function getContainer()
    {
        $container = new ContainerBuilder();

        $notifier = new Definition('test_notifier');
        $notifier->addTag('notify.notifier', array('alias' => 'test_notifier'));
        $container->setDefinition('test_notifier', $notifier);

        $extension = new NotifyExtension();
        $container->registerExtension($extension);

        $bundle = new NotifyBundle();
        $bundle->build($container);

        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->getCompilerPassConfig()->setAfterRemovingPasses(array());

        $container->loadFromExtension('notify', array());
        $container->compile();

        return $container;
    }
}
