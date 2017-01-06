<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ProductServiceInterface
{
    /**
     * Find a list of products by category.
     *
     * @param int|null $productCategoryId
     * @param int $page (optional)
     *
     * @return PaginationInterface
     */
    function findAll($productCategoryId, $page = 1);

    /**
     * Return a list of all categories.
     *
     * @return ArrayCollection
     */
    function findAllCategories();

    /**
     * Create new product by current user.
     *
     * @param Product $product
     *
     * @return void
     */
    function save(Product $product);
}