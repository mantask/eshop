<?php

namespace AppBundle\Util;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;

trait EntityManagerAwareTrait
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @DI\InjectParams({
     *      "entityManager" = @DI\Inject("doctrine.orm.entity_manager"),
     * })
     *
     * @param ObjectManager $entityManager
     */
    public function setEntityManager(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
