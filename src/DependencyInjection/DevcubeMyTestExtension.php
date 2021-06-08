<?php

namespace Devcube\Bundle\MyTestBundle\DependencyInjection;

use Devcube\Bundle\MyTestBundle\Service\DevcubeSimpleOneService;
use Devcube\Bundle\MyTestBundle\Service\DevcubeSimpleTwoService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DevcubeMyTestExtension extends Extension
{
    /**
     * @var array
     */
    private $processedConfig;

    public function load(array $configs, ContainerBuilder $container): void
    {
        /**
         * definicja konfiguracji
         * @var Configuration
         */
        $configuration = $this->getConfiguration($configs, $container);

        /**
         * konfiguracja dla tego bundle
         * @var array
         */
        $this->processedConfig = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
//        dump('123');
//        if (!$this->processedConfig['service_one_active']) {
//            $container->removeDefinition('devcube.service.service_one');
//        }
//
//        if (!$this->processedConfig['service_two_active']) {
//            $container->removeDefinition('devcube.service.service_two');
//            $container->removeAlias('devcube.service.service_two');
//        }
    }

    /**
     * @internal
     */
    public function getProcessedConfig(): array
    {
        return $this->processedConfig;
    }
}
