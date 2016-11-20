<?php

namespace AppBundle\Service;

use AppBundle\Entity\Order;
use AppBundle\Entity\OrderItem;
use AppBundle\Entity\Product;
use AppBundle\Util\EntityManagerAwareTrait;
use AppBundle\Util\PaginatorAwareTrait;
use AppBundle\Util\UserAwareTrait;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.order_service")
 */
class OrderService
{
    use EntityManagerAwareTrait;
    use PaginatorAwareTrait;
    use UserAwareTrait;

    /**
     * Find current order by active user.
     *
     * @return Order
     */
    public function current()
    {
        $user = $this->getUser();

        $order = $this->entityManager
            ->getRepository(Order::class)
            ->findActiveByUser($user);

        if ($order == null) {
            $order = new Order();
            $order->setUser($user);

            $this->entityManager->persist($order);
            $this->entityManager->flush($order);
        }

        return $order;
    }

    /**
     * Add product to current order by active user.
     *
     * @param Product $product
     *
     * @return void
     */
    public function addProduct(Product $product)
    {
        $order = $this->current();
        $order->addProduct($product);

        $this->entityManager->flush();
    }

    /**
     * Submit current order by active user.
     *
     * @return void
     */
    public function submit()
    {
        $order = $this->current();
        $order->submit();

        $this->entityManager->flush();
    }

    /**
     * Return a list of order items that have been submitted on products by active user.
     *
     * @param int $page (optional)
     *
     * @return PaginationInterface
     */
    public function my($page = 1)
    {
        $user = $this->getUser();

        $qb = $this->entityManager
            ->getRepository(OrderItem::class)
            ->queryOrderedFromUser($user);

        return $this->paginator->paginate($qb, $page);
    }
}
