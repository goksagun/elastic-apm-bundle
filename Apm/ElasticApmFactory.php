<?php

namespace Chq81\ElasticApmBundle\Apm;

use Nipwaayoni\AgentBuilder;
use Nipwaayoni\Config;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

/**
 * This class describes the factory for the Elastic APM agent.
 */
class ElasticApmFactory
{
    /**
     * Creates the APM agent.
     *
     * @param array $config
     * @param ClientInterface|null $client
     * @param LoggerInterface|null $logger
     * @return \Nipwaayoni\ApmAgent
     * @throws \Nipwaayoni\Exception\ConfigurationException
     * @throws \Nipwaayoni\Exception\Helper\UnsupportedConfigurationValueException
     * @throws \Nipwaayoni\Exception\MissingServiceNameException
     */
    public static function createAgent(
        array $config = [],
        ?ClientInterface $client = null,
        ?LoggerInterface $logger = null
    ) {
        // Check php sapi is cli disable apm agent
        if (PHP_SAPI === 'cli') {
            $config['enabled'] = false;
        }

        $agentBuilder = new AgentBuilder();

        if (array_key_exists('env', $config) && !empty($config['env'])) {
            $agentBuilder->withEnvData($config['env']);
        }
        if (array_key_exists('cookies', $config) && !empty($config['cookies'])) {
            $agentBuilder->withCookieData($config['cookies']);
        }
        if ($client instanceof ClientInterface) {
            $agentBuilder->withHttpClient($client);
        }
        if ($logger instanceof LoggerInterface) {
            $config['logger'] = $logger;
        }

        unset($config['env'], $config['cookies'], $config['httpClient']);
        $config = new Config($config);

        return $agentBuilder->withConfig($config)->build();
    }
}
