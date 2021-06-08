<?php

namespace Devcube\Bundle\MyTestBundle;

use Devcube\Bundle\MyTestBundle\DependencyInjection\Compiler\DisableServicesPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DevcubeMyTestBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        // lower priority than CacheCompatibilityPass from DoctrineBundle
        $container->addCompilerPass(new DisableServicesPass());

        $container->setParameter('devcube_my_test.some_parameter', 'Wartosc parametru');
    }
}
