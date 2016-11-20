<?php

namespace AppBundle\EventListener;

use AppBundle\Util\RouterAwareTrait;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @DI\Service
 */
class RegistrationSuccessListener
{
    use RouterAwareTrait;

    /**
     * @DI\Observe(FOSUserEvents::REGISTRATION_SUCCESS)
     *
     * @param FormEvent $event
     *
     * @return void
     */
    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('default');
        $event->setResponse(new RedirectResponse($url));
    }
}