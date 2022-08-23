<?php

namespace Goksagun\ElasticApmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('elastic_apm');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // symfony < 4.2 support
            $rootNode = $treeBuilder->root('elastic_apm');
        }

        $rootNode
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
            ->end()
            ->children()
                ->scalarNode('appName')->isRequired()->end()
            ->end()
            ->children()
                ->scalarNode('appVersion')->defaultValue('')->end()
            ->end()
            ->children()
                ->scalarNode('environment')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('serverUrl')->defaultValue('http://127.0.0.1:8200')->end()
            ->end()
            ->children()
                ->arrayNode('httpClient')
                    ->children()
                        ->booleanNode('verify')->defaultTrue()->end()
                    ->end()
                    ->children()
                        ->scalarNode('proxy')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
            ->children()
                ->scalarNode('secretToken')->defaultNull()->end()
            ->end()
            ->children()
                ->integerNode('timeout')->defaultValue(5)->end()
            ->end()
            ->fixXmlConfig('transaction')
            ->children()
                ->arrayNode('transactions')
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end()
            ->fixXmlConfig('error')
            ->children()
                ->arrayNode('errors')
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                    ->end()
                    ->children()
                        ->arrayNode('exclude')
                            ->children()
                                ->arrayNode('status_codes')
                                    ->scalarPrototype()->end()
                                ->end()
                            ->end()
                            ->children()
                                ->arrayNode('exceptions')
                                    ->scalarPrototype()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
