<?php

namespace App\Card;

class Deck
{
    protected $allCards;
    private $allSuites = ["\u{2665}", "\u{2666}", "\u{2660}", "\u{2663}"];
    private $allValues = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
    private $remainingCards;

    public function __construct()
    {
        $this->allCards = [];
        $this->addCards();
    }

    private function addCards()
    {
        foreach ($this->allSuites as $suit) {
            foreach ($this->allValues as $value) {
                array_push($this->allCards, new \App\Card\Card($suit, $value));
            }
        }
        $this->remainingCards = $this->allCards;
    }

    public function getAllCards()
    {
        return $this->allCards;
    }

    public function getCards()
    {
        return $this->remainingCards;
    }

    public function shuffleCards()
    {
        $this->remainingCards = $this->allCards;
        shuffle($this->remainingCards);
        return $this->remainingCards;
    }

    public function drawCard(int $nrOfCards)
    {
        $usedCards = [];
        for ($x = 0; $x < $nrOfCards; $x++) {
            array_push($usedCards, array_pop($this->remainingCards));
        }
        return $usedCards;
    }

    public function cardsLeft()
    {
        return count($this->remainingCards);
    }
}
