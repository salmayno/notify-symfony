<?php

namespace Notify\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ProducerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('notify.producer')) {
            return;
        }

        /** @var \Notify\Producer\ProducerManager $manager */
        $manager = $container->findDefinition('notify.producer');

        foreach ($container->findTaggedServiceIds('notify.producer') as $id => $tags) {
            foreach ($tags as $attributes) {
                $manager->addMethodCall('addDriver', array(
                    $attributes['alias'],
                    new Reference($id),
                ));
            }
        }
    }
}
