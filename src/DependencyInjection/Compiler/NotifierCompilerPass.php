<?php

namespace Yoeunes\Notify\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class NotifierCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('notify')) {
            return;
        }

        /** @var \Yoeunes\Notify\NotifyManager $manager */
        $manager = $container->findDefinition('notify');

        foreach ($container->findTaggedServiceIds('notify.notifier') as $id => $tags) {
            foreach ($tags as $attributes) {
                $manager->addMethodCall('extend', array(
                    $attributes['alias'],
                    new Reference($id)
                ));
            }
        }
    }
}
