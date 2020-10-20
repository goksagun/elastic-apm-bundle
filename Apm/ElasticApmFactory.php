<?php

namespace Goksagun\ElasticApmBundle\Apm;

use Nipwaayoni\AgentBuilder;
use Nipwaayoni\Config;
use Psr\Log\LoggerInterface;

class ElasticApmFactory
{
    /**
     *
     *
     * @param array $config
     * @param LoggerInterface $logger
     * @return \Nipwaayoni\ApmAgent
     * @throws \Nipwaayoni\Exception\ConfigurationException
     * @throws \Nipwaayoni\Exception\Helper\UnsupportedConfigurationValueException
     * @throws \Nipwaayoni\Exception\MissingServiceNameException
     */
    public static function createAgent(array $config = [], ?LoggerInterface $logger = null)
    {
        // Check php sapi is cli disable apm agent
        if (PHP_SAPI === 'cli') {
            $config['enabled'] = false;
        }

        $agentBuilder = new AgentBuilder();

        if (array_key_exists('env', $config) && !empty($config['env'])) {
            $agentBuilder->withEnvData($config['env']);
            unset($config['env']);
        }
        if (array_key_exists('cookies', $config) && !empty($config['cookies'])) {
            $agentBuilder->withCookieData($config['cookies']);
            unset($config['cookies']);
        }
        if (array_key_exists('httpClient', $config) && !empty($config['httpClient'])) {
            $agentBuilder->withHttpClient($config['httpClient']);
            unset($config['httpClient']);
        }
        if ((!array_key_exists('logger', $config) || !$config['logger'] instanceof LoggerInterface)
            && $logger instanceof LoggerInterface
        ) {
            $config['logger'] = $logger;
        }

        $config = new Config($config);

        return $agentBuilder->withConfig($config)->build();
    }
}
