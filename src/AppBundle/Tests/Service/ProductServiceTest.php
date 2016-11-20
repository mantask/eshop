<?php

namespace AppBundle\Tests\Service;

use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Service\ProductService;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProductServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testSave_WhenProductSaved_ThenCurrentUserIsSet()
    {
        $product = new Product();
        $user = new User();

        $productService = new ProductService();
        $productService->setEntityManager($this->mockEntityManager());
        $productService->setTokenStorage($this->mockTokenStorage($user));
        $productService->setPaginator($this->mockPaginagor());

        $productService->save($product);

        $this->assertEquals($user, $product->getSeller());
    }

    private function mockEntityManager()
    {
        return $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function mockTokenStorage(User $user)
    {
        $tokenStorage = $this->getMockBuilder(TokenStorageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $tokenStorage
            ->expects($this->any())
            ->method('getToken')
            ->willReturn($this->mockToken($user));

        return $tokenStorage;
    }

    private function mockPaginagor()
    {
        return $this->getMockBuilder(Paginator::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function mockToken($user)
    {
        $token = $this->getMockBuilder(TokenInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $token
            ->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        return $token;
    }
}