<?php

namespace Notify\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class PresenterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('notify.presenter')) {
            return;
        }

        /** @var \Notify\Presenter\PresenterManager $manager */
        $manager = $container->findDefinition('notify.presenter');

        foreach ($container->findTaggedServiceIds('notify.presenter') as $id => $tags) {
            foreach ($tags as $attributes) {
                $manager->addMethodCall('addDriver', array(
                    $attributes['alias'],
                    new Reference($id),
                ));
            }
        }
    }
}
