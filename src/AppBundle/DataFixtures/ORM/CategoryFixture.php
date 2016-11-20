<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ProductCategory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        foreach (['Knygos', 'Filmai', 'Rūbai'] as $categoryName)
            $em->persist(
                new ProductCategory($categoryName)
            );

        $em->flush();
    }
}
