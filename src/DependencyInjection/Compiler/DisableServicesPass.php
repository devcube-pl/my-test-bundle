<?php

namespace Devcube\Bundle\MyTestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DisableServicesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $extension = $container->getExtension('devcube_my_test');
        $config = $extension->getProcessedConfig();


        if (!$config['service_one_active']) {
            $container->removeDefinition('devcube.service.service_one');
        }

        if (!$config['service_two_active']) {
            $container->removeDefinition('devcube.service.service_two');
        }
    }
}
