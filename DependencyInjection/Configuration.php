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
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
            ->end()
            ->children()
                ->scalarNode('serviceName')->isRequired()->end()
            ->end()
            ->children()
                ->scalarNode('serviceVersion')->defaultValue('')->end()
            ->end()
            ->children()
                ->scalarNode('frameworkName')->defaultValue('')->end()
            ->end()
            ->children()
                ->scalarNode('frameworkVersion')->defaultValue('')->end()
            ->end()
            ->children()
                ->scalarNode('environment')->defaultValue('dev')->end()
            ->end()
            ->children()
                ->scalarNode('serverUrl')->defaultValue('http://127.0.0.1:8200')->end()
            ->end()
            ->children()
                ->scalarNode('secretToken')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('hostname')->defaultNull()->end()
            ->end()
            ->children()
                ->arrayNode('env')->defaultValue([])->end()
            ->end()
            ->children()
                ->arrayNode('cookies')->defaultValue([])->end()
            ->end()
            ->children()
                ->scalarNode('httpClient')->defaultNull()->end()
            ->end()
            ->children()
                ->integerNode('timeout')->defaultValue(10)->end()
            ->end()
            ->children()
                ->scalarNode('logger')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('logLevel')->defaultValue('INFO')->end()
            ->end()
            ->children()
                ->integerNode('stackTraceLimit')->defaultValue(0)->end()
            ->end()
            ->children()
                ->floatNode('transactionSampleRate')->defaultValue(1.0)->end()
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
