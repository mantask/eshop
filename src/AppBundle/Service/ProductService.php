<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use AppBundle\Util\EntityManagerAwareTrait;
use AppBundle\Util\PaginatorAwareTrait;
use AppBundle\Util\UserAwareTrait;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.product_service")
 */
class ProductService
{
    use EntityManagerAwareTrait;
    use PaginatorAwareTrait;
    use UserAwareTrait;

    /**
     * @inheritdoc
     */
    public function findAll($productCategoryId, $page = 1)
    {
        $qb = $this->entityManager
            ->getRepository(Product::class)
            ->queryByCategoryId($productCategoryId);

        return $this->paginator->paginate($qb, $page);
    }

    /**
     * @inheritdoc
     */
    public function findAllCategories()
    {
        return $this->entityManager
            ->getRepository(ProductCategory::class)
            ->findAll();
    }

    /**
     * @inheritdoc
     */
    function save(Product $product)
    {
        $product->setSeller($this->getUser());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
