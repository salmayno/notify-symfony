<?php

namespace Yoeunes\Notify\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('notify');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('default')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('toastr')
                ->end()
                ->arrayNode('notifiers')
                    ->isRequired()
                    ->ignoreExtraKeys(false)
                    ->useAttributeAsKey('notifier')
                    ->arrayPrototype()
                        ->isRequired()
                        ->ignoreExtraKeys(false)
                        ->performNoDeepMerging()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}