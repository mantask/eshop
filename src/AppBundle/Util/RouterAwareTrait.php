<?php

namespace AppBundle\Util;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Routing\Router;

trait RouterAwareTrait
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @DI\InjectParams
     *
     * @param Router $router
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
    }
}
