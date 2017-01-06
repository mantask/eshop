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
class OrderService implements OrderServiceInterface
{
    use EntityManagerAwareTrait;
    use PaginatorAwareTrait;
    use UserAwareTrait;

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function addProduct(Product $product)
    {
        $order = $this->current();
        $order->addProduct($product);

        $this->entityManager->flush();
    }

    /**
     * @inheritdoc
     */
    public function submit()
    {
        $order = $this->current();
        $order->submit();

        $this->entityManager->flush();
    }

    /**
     * @inheritdoc
     */
    public function my($page = 1)
    {
        $user = $this->getUser();

        $qb = $this->entityManager
            ->getRepository(OrderItem::class)
            ->queryOrderedByUser($user);

        return $this->paginator->paginate($qb, $page);
    }
}
