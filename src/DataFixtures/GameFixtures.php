<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $games = [
            [
                "title" => "Portal 2",
                "description" => "Cake and lies",
                "rating" => 10,
                "picture" => 'https://s2.gaming-cdn.com/images/products/220/orig/jeu-steam-portal-2-cover.jpg'
            ],
            [
                "title" => "Crazy Frog Racer",
                "description" => "Mario Kart sous acide",
                "rating" => 3.5,
                "picture" => 'https://static.fnac-static.com/multimedia/images_produits/ZoomPE/3/6/4/5060074850463/tsp20130828104721/Crazy-Frog-Racer.jpg'
            ],
            [
                "title" => "Adibou",
                "description" => "Ceci n'est pas un jeu",
                "rating" => 15,
                "picture" => 'https://www.covercentury.com/covers/psx/a/Adibou-Ombre-Verte-PAL-PSX-FRONT.jpg'
            ],
        ];

        foreach ($games as $gameInfos) {
            $game = new Game();

            $game->setTitle($gameInfos['title']);
            $game->setDescription($gameInfos['description']);
            $game->setRating($gameInfos['rating']);
            $game->setPicture($gameInfos['picture']);
            $manager->persist($game);
        }

        $manager->flush();
    }
}
