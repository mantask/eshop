<?php

namespace AppBundle\Util;

use JMS\DiExtraBundle\Annotation as DI;
use Knp\Component\Pager\Paginator;

trait PaginatorAwareTrait
{
    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @DI\InjectParams({
     *      "paginator" = @DI\Inject("knp_paginator"),
     * })
     *
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }
}
