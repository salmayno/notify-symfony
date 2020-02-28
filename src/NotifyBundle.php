<?php

namespace Yoeunes\Notify\Symfony;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Yoeunes\Notify\Symfony\DependencyInjection\Compiler\NotifierCompilerPass;

class NotifyBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
//        $container->addCompilerPass(new NotifierCompilerPass());
    }
}
