<?php

namespace Goksagun\ElasticApmBundle\EventListener;

use Symfony\Component\Security\Core\Security;

/**
 *
 */
interface UserContextAwareInterface
{
    /**
     * @param Security $securityHelper
     * @return void
     */
    public function setSecurityHelper(Security $securityHelper): void;
}
