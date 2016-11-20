<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testAddProduct_WhenProductAdded_ThenTotalUpdated()
    {
        $product = new Product();
        $product->setTitle('test');
        $product->setPrice(9.99);

        $order = new Order();
        $order->addProduct($product);

        $this->assertEquals(9.99, $order->getTotalPrice());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAddProduct_WhenOrderIsSubmitted_ThenException()
    {
        $product = new Product();
        $product->setTitle('test');
        $product->setPrice(9.99);

        $order = new Order();
        $order->addProduct($product);
        $order->submit();

        $order->addProduct($product); // exception
    }
}