<?php

namespace AppBundle\Entity;

use AppBundle\Util\IdentifiableEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    use IdentifiableEntityTrait;

    /**
     * @var float
     *
     * @ORM\Column(precision=10, scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $photo;

    /**
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="ProductCategory")
     */
    private $categories;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $seller;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdOn;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->createdOn = new \DateTime();
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param ArrayCollection $categories
     *
     * @return $this
     */
    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param ProductCategory $productCategory
     *
     * @return $this
     */
    public function addProductCategory(ProductCategory $productCategory)
    {
        if (!$this->categories->contains($productCategory))
            $this->categories->add($productCategory);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param User $seller
     *
     * @return $this
     */
    public function setSeller(User $seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @return User
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $photo
     *
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}
