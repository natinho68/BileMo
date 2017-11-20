<?php

namespace AppBundle\DataFixtures\ORM;

use Symfony\Component\Yaml\Yaml;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;


class LoadingDatas {

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getDatas($file)
    {
        $fixturesPath = __DIR__ . '/fixtures/';
        $fixtures = Yaml::parse(file_get_contents( $fixturesPath .  $file .'.yml', true));
        return $fixtures;
    }

    public function loadProducts()
    {
        $product = $this->getDatas('products');
        foreach ($product['Product'] as $reference => $columns) {
            $product = new Product();
            $product->setName($columns['name']);
            $product->setPrice($columns['price']);
            $product->setDescription($columns['description']);
            $product->setQuantityAvailable($columns['quantity']);
            $product->setColor($columns['color']);
            $product->setOs($columns['os']);
            $product->setCapacity($columns['capacity']);
            $product->setTechnicalSpec($columns['technical_spec']);
            $product->setBrand($columns['brand']);
            $this->em->persist($product);

        }
            $this->em->flush();
    }

}
