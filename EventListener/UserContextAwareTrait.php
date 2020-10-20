<?php

namespace Goksagun\ElasticApmBundle\EventListener;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\User;

/**
 *
 */
trait UserContextAwareTrait
{
    /**
     * @var Security
     */
    private $securityHelper;

    /**
     *
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
