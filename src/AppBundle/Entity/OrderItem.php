<?php

namespace AppBundle\Entity;

use AppBundle\Util\IdentifiableEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="order_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderItemRepository")
 */
class OrderItem
{
    use IdentifiableEntityTrait;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="items")
     */
    private $order;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(precision=10, scale=2)
     */
    private $price;

    /**
     * @param Order $order
     * @param Product $product
     */
    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
        $this->price = $product->getPrice();
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}

