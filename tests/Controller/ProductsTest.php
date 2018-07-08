<?php

namespace App\Tests\Controller;

use App\Controller\ProductsController;
use PHPUnit\Framework\TestCase;
use App\Entity\Products;

class ProductsTest extends TestCase {

    public function testBasketTotalPrice() {
        $panier = array();

        $product1 = new Products();
        $product1->setName('Product1');
        $product1->setDescription('Desc1');
        $product1->setPrice(250);

        $product2 = new Products();
        $product2->setName('Product2');
        $product2->setDescription('Desc2');
        $product2->setPrice(100);

        $panier = array(
            array($product1, 1),
            array($product2, 2)
        );

        $products = new ProductsController();
        $total_price = $products->basketTotalPrice($panier);

        $this->assertEquals(450, $total_price);
    }

}