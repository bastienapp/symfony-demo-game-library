<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Action',
            'Plate-forme',
            'FPS',
            'Simulation',
            'Éducatif',
        ];

        foreach ($categories as $key => $categoryName) {
            $category = new Category();

            $category->setName($categoryName);
            $manager->persist($category);

            $this->addReference('category_' . $key, $category);
        }

        $manager->flush();
    }
}
