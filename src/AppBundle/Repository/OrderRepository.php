<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function findActiveByUser(User $user)
    {
        $qb = $this->createQueryBuilder('ordr')
            ->leftJoin('ordr.items', 'item')
            ->andWhere('ordr.isSubmitted = false')
            ->andWhere('ordr.user = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
