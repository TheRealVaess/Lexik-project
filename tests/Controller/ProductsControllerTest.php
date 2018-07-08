<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Products;
use App\Controller\ProductsController;

class ProductsControllerTest extends WebTestCase {

    public function testIndex() {
        $client = static::createClient();

        $client->request('GET', '/products');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}