<?php

namespace Chq81\ElasticApmBundle\EventListener;

use Symfony\Component\Security\Core\Security;

/**
 * This interface makes services aware of the user context.
 */
interface UserContextAwareInterface
{
    /**
     * @param Security $securityHelper
     * @return void
     */
    public function setSecurityHelper(Security $securityHelper): void;
}
