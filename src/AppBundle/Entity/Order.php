<?php

namespace AppBundle\Entity;

use AppBundle\Util\IdentifiableEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
{
    use IdentifiableEntityTrait;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var ArrayCollection 
     *
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order", cascade={ "persist", "remove" })
     */
    private $items;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isSubmitted = false;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $totalPrice = 0.00;


    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param ArrayCollection $items
     *
     * @return $this
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return bool
     */
    public function canAddProduct()
    {
        return !$this->isSubmitted;
    }

    /**
     * @param Product $product
     *
     * @return $this
     */
    public function addProduct(Product $product)
    {
        if (!$this->canAddProduct())
            throw new \RuntimeException('Cannot modify order. Already submitted.');

        $this->items->add(new OrderItem($this, $product));
        $this->totalPrice += $product->getPrice();

        return $this;
    }

    /**
     * @return bool
     */
    public function canSubmit()
    {
        return !$this->items->isEmpty();
    }

    /**
     * @return void
     */
    public function submit()
    {
        if (!$this->canSubmit())
            throw new \RuntimeException('Cannot submit an empty order.');

        $this->isSubmitted = true;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return boolean
     */
    public function getIsSubmitted()
    {
        return $this->isSubmitted;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
