<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $product = new Products();
            $product->setName('Product'.$i);
            $product->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In est urna, aliquet a velit a, porttitor auctor nisi. Quisque vel quam leo. Praesent rutrum felis ac dignissim sodales. Vivamus non tempor nunc. Suspendisse viverra elit est, a fermentum quam scelerisque et. Aliquam facilisis pellentesque tincidunt. Duis convallis placerat purus sit amet vehicula. Mauris fringilla lectus odio, sit amet rhoncus diam gravida eu. Curabitur vel sollicitudin nisl. Morbi et neque ac libero varius sodales nec ac velit. Duis quis sapien vulputate, accumsan odio nec, rhoncus nisi. Aliquam erat volutpat. Fusce semper laoreet mauris, in dapibus leo tristique mollis.');
            $product->setPrice(mt_rand(10, 1000));
            $manager->persist($product);
        }

        $manager->flush();
    }
}