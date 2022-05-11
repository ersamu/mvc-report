<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Card\Deck;
use App\Card\DeckWith2Jokers;

class CardStartController extends AbstractController
{
    /**
     * @Route("/card", name="card-home")
     */
    public function home(): Response
    {
        $data = [
            'title' => 'Kortlänkar',
        ];
        return $this->render('card-home.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="card-deck")
     */
    public function deck(): Response
    {
        $deck = new Deck();
        $getAllCards = $deck->getAllCards();

        $data = [
            'title' => 'Visar samtliga kort sorterade',
            'cards' => $getAllCards,
        ];
        return $this->render('card-deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="card-deck2")
     */
    public function deck2(): Response
    {
        $deck2 = new DeckWith2Jokers();
        $deck2->addJokers();
        $getAllCards = $deck2->getAllCards();

        $data = [
            'title' => 'Visar samtliga kort sorterade, med jokrar',
            'cards' => $getAllCards,
        ];
        return $this->render('card-deck.html.twig', $data);
    }
}
