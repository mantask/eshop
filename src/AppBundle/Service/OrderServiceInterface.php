<?php

namespace AppBundle\Service;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface OrderServiceInterface
{
    /**
     * Find current order by active user.
     *
     * @return Order
     */
    public function current();

    /**
     * Add product to current order by active user.
     *
     * @param Product $product
     *
     * @return void
     */
    function addProduct(Product $product);

    /**
     * Submit current order by active user.
     *
     * @return void
     */
    function submit();

    /**
     * Return a list of order items that have been submitted on products by active user.
     *
     * @param int $page (optional)
     *
     * @return PaginationInterface
     */
    function my($page = 1);
}