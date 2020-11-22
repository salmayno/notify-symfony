<?php

namespace Notify\Symfony;

use Notify\Symfony\DependencyInjection\Compiler\FilterCompilerPass;
use Notify\Symfony\DependencyInjection\Compiler\ProducerCompilerPass;
use Notify\Symfony\DependencyInjection\Compiler\RendererCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NotifyBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ProducerCompilerPass());
        $container->addCompilerPass(new RendererCompilerPass());
        $container->addCompilerPass(new FilterCompilerPass());
    }
}
