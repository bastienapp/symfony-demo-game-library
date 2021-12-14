<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $games = [
            [
                'title' => 'Portal 2',
                'description' => 'Cake and lies',
                'rating' => 10,
                'picture' => 'https://s2.gaming-cdn.com/images/products/220/orig/jeu-steam-portal-2-cover.jpg',
                'publisher' => 'publisher_1',
                'categories' => [
                    'category_0',
                    'category_1',
                    'category_2',
                ]
            ],
            [
                'title' => 'Crazy Frog Racer',
                'description' => 'Mario Kart sous acide',
                'rating' => 3.5,
                'picture' => 'https://static.fnac-static.com/multimedia/images_produits/ZoomPE/3/6/4/5060074850463/tsp20130828104721/Crazy-Frog-Racer.jpg',
                'publisher' => 'publisher_0',
                'categories' => [
                    'category_0',
                    'category_3',
                ]
            ],
            [
                'title' => 'Adibou',
                'description' => 'Ceci n\'est pas un jeu',
                'rating' => 15,
                'picture' => 'https://www.covercentury.com/covers/psx/a/Adibou-Ombre-Verte-PAL-PSX-FRONT.jpg',
                'publisher' => 'publisher_0',
                'categories' => [
                    'category_4',
                ]
            ],
        ];

        foreach ($games as $key => $gameInfos) {
            $game = new Game();

            $game->setTitle($gameInfos['title']);
            $game->setDescription($gameInfos['description']);
            $game->setRating($gameInfos['rating']);
            $game->setPicture($gameInfos['picture']);
            $publisher = $this->getReference($gameInfos['publisher']);
            $game->setPublisher($publisher);
            foreach ($gameInfos['categories'] as $categoryReference) {
                $category = $this->getReference($categoryReference);
                $game->addCategory($category);
            }
            $manager->persist($game);

            $this->addReference('game_' . $key, $game);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PublisherFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
