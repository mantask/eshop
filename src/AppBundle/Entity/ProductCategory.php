<?php

namespace AppBundle\Entity;

use AppBundle\Util\IdentifiableEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_categories")
 * @ORM\Entity
 */
class ProductCategory
{
    use IdentifiableEntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;


    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
