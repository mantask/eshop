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
     * Find a list of products by category.
     *
     * @param int|null $productCategoryId
     * @param int $page (optional)
     *
     * @return PaginationInterface
     */
    public function findAll($productCategoryId, $page = 1)
    {
        $qb = $this->entityManager
            ->getRepository(Product::class)
            ->queryByCategoryId($productCategoryId);

        return $this->paginator->paginate($qb, $page);
    }

    /**
     * Return a list of all categories.
     *
     * @return ArrayCollection
     */
    public function findAllCategories()
    {
        return $this->entityManager
            ->getRepository(ProductCategory::class)
            ->findAll();
    }

    /**
     * Create new product by current user.
     *
     * @param Product $product
     *
     * @return void
     */
    function save(Product $product)
    {
        $product->setSeller($this->getUser());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
