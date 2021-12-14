<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $publishers = [
            [
                'name' => 'Valve',
                'address' => 'address_1',
            ],
            [
                'name' => 'Ubisoft',
                'address' => 'address_0',
            ],
        ];

        foreach ($publishers as $key => $publisherInfos) {
            $publisher = new Publisher();

            $publisher->setName($publisherInfos['name']);
            $address= $this->getReference($publisherInfos['address']);
            $publisher->setAddress($address);
            $manager->persist($publisher);

            $this->addReference('publisher_' . $key, $publisher);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AddressFixtures::class,
        ];
    }
}
