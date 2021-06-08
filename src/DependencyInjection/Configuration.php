<?php

namespace Devcube\Bundle\MyTestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('devcube_my_test');

        $root = $treeBuilder->getRootNode();

        $root
            ->addDefaultsIfNotSet()
            ->children()
                ->variableNode('some_options')
                    ->defaultTrue()
                    ->validate()
                    ->ifTrue(function ($value) {
                        if (is_bool($value)) {
                            return false;
                        }

                        if (!is_array($value)) {
                            return true;
                        }

                        foreach ($value as $k => $v) {
                            if (!is_string($k) || !is_bool($v)) {
                                return true;
                            }
                        }

                        return false;
                    })
                    ->thenInvalid('Must be a boolean or an array with name -> bool')
                    ->end()
                ->end()
                ->booleanNode('service_one_active')->defaultTrue()->end()
                ->booleanNode('service_two_active')->defaultTrue()->end()
                ->arrayNode('defaults')
                    ->addDefaultsIfNotSet()
                    ->append($this->getMaxValue())
                    ->append($this->getHosts())
                ->end()
            ->end();

        return $treeBuilder;
    }

    private function getHosts(): ArrayNodeDefinition
    {
        $node = new ArrayNodeDefinition('hosts');

        $node->prototype('scalar')->end();

        return $node;
    }

    private function getMaxValue(): ScalarNodeDefinition
    {
        $node = new ScalarNodeDefinition('max_value');

        $node
            ->defaultValue(0)
            ->validate()
            ->ifTrue(function ($v) {
                return !is_numeric($v);
            })
            ->thenInvalid('max_value must be an integer (seconds)')
            ->end()
        ;

        return $node;
    }
}
