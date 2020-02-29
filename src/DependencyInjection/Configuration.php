<?php

namespace Yoeunes\Notify\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('notify');

        if (\method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('notify');
        }

        $rootNode
            ->children()
                ->scalarNode('default')
                    ->cannotBeEmpty()
                    ->defaultValue('basic')
                ->end()
                ->arrayNode('notifiers')
                    ->ignoreExtraKeys(false)
                    ->useAttributeAsKey('notifier_name')
                    ->prototype('variable')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
