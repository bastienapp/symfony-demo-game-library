<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/games", name="games_")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"}, name="show")
     */
    public function show(int $id): Response
    {
        $game = $this->getDoctrine()->getRepository(Game::class)->findOneBy(['id' => $id]);

        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }
}
