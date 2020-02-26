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
                    ->defaultValue('toastr')
                ->end()
                ->arrayNode('notifiers')
                    ->ignoreExtraKeys(false)
                    ->useAttributeAsKey('notifier')
                    ->prototype('array')
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
