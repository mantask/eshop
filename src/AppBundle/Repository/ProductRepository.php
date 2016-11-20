<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function queryByCategoryId($categoryId = null)
    {
        $qb = $this->createQueryBuilder('product')
            ->leftJoin('product.categories', 'category');

        if ($categoryId)
            $qb->andWhere('category.id = :categoryId')
                ->setParameter('categoryId', $categoryId);

        return $qb;
    }
}
