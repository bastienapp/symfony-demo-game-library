<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Game;
use App\Repository\CommentRepository;
use App\Repository\GameRepository;
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
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/category/{categoryName}", name="show_by_category_name")
     */
    public function showByCategoryName(string $categoryName, GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findByCategoryName($categoryName);

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"}, name="show")
     */
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }
}
