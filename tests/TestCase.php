<?php

namespace Yoeunes\Notify\Symfony\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Yoeunes\Notify\Symfony\DependencyInjection\NotifyExtension;
use Yoeunes\Notify\Symfony\NotifyBundle;

class TestCase extends BaseTestCase
{
    protected function getRawContainer()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', false);

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
