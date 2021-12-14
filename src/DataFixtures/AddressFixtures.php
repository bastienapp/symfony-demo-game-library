<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $addresses = [
            [
                'street' => '13 rue des pyrénées',
                'city' => 'Montpellier',
                'postal_code' => '34000',
                'country' => 'France'
            ],
            [
                'street' => '10400 Northeast Fourth Street Floor 14 ',
                'city' => 'Bellevue',
                'postal_code' => 'WA 98004',
                'country' => 'USA'
            ],
        ];

        foreach ($addresses as $key => $addressInfos) {
            $address = new Address();

            $address->setStreet($addressInfos['street']);
            $address->setCity($addressInfos['city']);
            $address->setPostalCode($addressInfos['postal_code']);
            $address->setCountry($addressInfos['country']);
            $manager->persist($address);

            $this->addReference('address_' . $key, $address);
        }

        $manager->flush();
    }
}
