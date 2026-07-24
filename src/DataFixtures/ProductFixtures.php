<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shampoo = new Product();
        $shampoo->setName('Shampoo');
        $shampoo->setShortDescription('Shampoo for all hair types');
        $shampoo->setFullDescription('Shampoo for all hair types, enriched with natural ingredients to nourish and protect your hair.');
        $shampoo->setPrice(10.99);
        $shampoo->setPicture('/public/img/shampoo.jpg');
        $manager->persist($shampoo);
        
        $creme = new Product();
        $creme->setName('Creme');
        $creme->setShortDescription('Creme for all skin types');
        $creme->setFullDescription('Creme for all skin types, enriched with natural ingredients to nourish and protect your skin.');
        $creme->setPrice(12.99);
        $creme->setPicture('/public/img/creme.jpg');
        $manager->persist($creme);

        $manager->flush();
    }
}
