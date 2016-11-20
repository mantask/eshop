<?php

namespace AppBundle\Util;

use AppBundle\Entity\User;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait UserAwareTrait
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @DI\InjectParams({
     *      "security" = @DI\Inject("security.token_storage"),
     * })
     *
     * @param TokenStorageInterface $security
     */
    public function setTokenStorage(TokenStorageInterface $security)
    {
        $this->tokenStorage = $security;
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        if ($token = $this->tokenStorage->getToken())
            return $token->getUser();
        else
            return null;
    }
}