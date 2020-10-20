<?php

namespace Goksagun\ElasticApmBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Log\Logger;
use UdBoffice\Bundle\UdBofficeBundle\Security\Http\EventListener\FirewallListener;

/**
 *
 */
class ApmAgentCompilerPass implements CompilerPassInterface
{
    /**
     * Sets the class of the security.firewall definition to boffice firewall.
     *
     * @param ContainerBuilder $container
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('elastic_apm.service.agent');

        $logger = $container->getDefinition(Logger::class);
        $definition->replaceArgument(1, $logger);
    }
}
