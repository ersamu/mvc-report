<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Card\Deck;
use App\Card\Game;
use App\Card\Player;

class GameController extends AbstractController
{
    /**
     * @Route("/game/play", name="game-play", methods={"GET","HEAD"})
     */
    public function playGame(SessionInterface $session): Response
    {
        $game = $session->get("game") ?? new Game(
            new Deck(),
            new Player(1, []),
            new Player(2, [])
        );

        $turn = $session->get("turn") ?? "Player";

        $session->set("game", $game);
        $session->set("turn", $turn);

        $data = [
            'title' => 'Spela 21',
            'playerHand' => $game->getPlayerHand(),
            'computerHand' => $game->getComputerHand(),
            'playerSum' => $game->getPlayerSum(),
            'computerSum' => $game->getComputerSum(),
            'turn' => $turn
        ];
        return $this->render('game-play.html.twig', $data);
    }

    /**
     * @Route("/game/play", name="game-play-process", methods={"POST"})
     */
    public function playGameProcess(Request $request, SessionInterface $session): Response
    {
        $game = $session->get("game");
        $session->get("turn");

        $draw = $request->request->get("draw");
        $stop = $request->request->get("stop");
        $newGame = $request->request->get("newGame");

        if ($draw) {
            $game->drawCard(1);
            if ($game->checkWinDirect()) {
                $this->addFlash("info", "Banken vann!");
                $session->set("turn", "Computer");
            /** @phpstan-ignore-next-line */
            } elseif (!$game->checkWinDirect()) {
                $session->set("turn", "Player");
            };
        } elseif ($stop) {
            $this->addFlash("info", $game->computerDraw());
            $session->set("turn", "Computer");
        } elseif ($newGame) {
            $game->resetGame();
            $session->set("turn", "Player");
        }
        return $this->redirectToRoute('game-play');
    }
}
