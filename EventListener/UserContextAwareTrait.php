<?php

namespace Chq81\ElasticApmBundle\EventListener;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\User;

/**
 * This trait provides access to the user context.
 */
trait UserContextAwareTrait
{
    /**
     * @var Security
     */
    private $securityHelper;

    /**
     * Retrieves the user context.
     *
     * @return array
     */
    protected function getUserContext(): array
    {
        $userContext = [];
        /** @var User $user */
        if ($user = $this->securityHelper->getUser()) {
            $userContext['username'] = $user->getUsername();

            if (method_exists($user, 'getId')) {
                $userContext['id'] = $user->getId();
            }

            if (method_exists($user, 'getEmail')) {
                $userContext['email'] = $user->getEmail();
            }

            if (method_exists($user, 'getRoles')) {
                $userContext['roles'] = $user->getRoles();
            }
        }

        return $userContext;
    }

    /**
     * @required
     *
     * @param Security $securityHelper
     * @return void
     */
    public function setSecurityHelper(Security $securityHelper): void
    {
        $this->securityHelper = $securityHelper;
    }
}
