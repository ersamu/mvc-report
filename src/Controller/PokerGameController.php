<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Poker\Deck;
use App\Poker\Board;
use App\Entity\TotalScore;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\TotalScoreRepository;

class PokerGameController extends AbstractController
{
    /**
     * @Route("/proj/play", name="poker-play", methods={"GET","HEAD"})
     */
    public function play(ManagerRegistry $doctrine, SessionInterface $session): Response
    {
        $entityManager = $doctrine->getManager();
        $score = $entityManager->getRepository(TotalScore::class)->find(1);

        if (!$score) {
            $score = new TotalScore();
            $score->setScore(0);
            $entityManager->persist($score);
            $entityManager->flush();
            $score = $entityManager->getRepository(TotalScore::class)->find(1);
        }

        $deck = $session->get("deck") ?? new Deck();

        if ($deck->nrOfDrawnCards() === 0) {
            $deck->shuffleCards();
        }

        $session->set("deck", $deck);

        $board = $session->get("board") ?? new Board();
        $session->set("board", $board);

        $data = [
            "title" => "Spela",
            "randomCard" => $deck->lastDrawnCard(),
            "board" => $board->getBoard(),
            "selectedBoxes" => $board->getSelectedBoxes(),
            "drawnCards" => $deck->nrOfDrawnCards(),
            "countSelectedBoxes" => $board->countSelectedBoxes()
        ];

        if ($board->countSelectedBoxes() === 25) {
            if (!$board->roundIsEnd()) {
                $board->setHands();
                $score->setScore($board->getScore());
                $entityManager->flush();
            }
            $data["getScore"] = $board->getScore();
            $data["checkWin"] = $board->checkWin();
        }

        return $this->render("poker/play.html.twig", $data);
    }

    /**
     * @Route("/proj/play", name="poker-play-process", methods={"POST"})
     */
    public function playProcess(SessionInterface $session, Request $request): Response
    {
        $box = $request->request->get("cardbox");
        $newGame = $request->request->get("newGame");
        $money = $request->request->get("money");

        $board = $session->get("board");
        $deck = $session->get("deck");

        if ($box) {
            $board->addCard($box - 1, $deck->lastDrawnCard());
        }

        if ($board->countSelectedBoxes() != 25 || $money) {
            $deck->drawCard();
        }

        $session->set("deck", $deck);
        $session->set("board", $board);

        if ($newGame) {
            $session->clear();
        }

        return $this->redirectToRoute("poker-play");
    }
}
