<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class OrderItemRepository extends EntityRepository
{
    public function queryOrderedByUser(User $user)
    {
        return $this->createQueryBuilder('orderItem')
            ->innerJoin('orderItem.order', 'ordr')
            ->innerJoin('orderItem.product', 'product')
            ->andWhere('ordr.isSubmitted = true')
            ->andWhere('product.seller = :user')
            ->setParameter('user', $user)
            ->addOrderBy('ordr.id', 'asc');
    }
}
