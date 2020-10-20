<?php

namespace Goksagun\ElasticApmBundle;

use Goksagun\ElasticApmBundle\DependencyInjection\Compiler\ApmAgentCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElasticApmBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ApmAgentCompilerPass());
    }
}
