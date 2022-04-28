<?php

namespace App\Card;

use App\Controller;

class Deck
{
    protected array $allCards;
    private array $allSuites = ["\u{2665}", "\u{2666}", "\u{2660}", "\u{2663}"];
    private array $allValues = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
    private array $remainingCards;

    public function __construct()
    {
        $this->allCards = [];
        $this->addCards();
    }

    private function addCards(): void
    {
        foreach ($this->allSuites as $suit) {
            foreach ($this->allValues as $value) {
                array_push($this->allCards, new Card($suit, $value));
            }
        }
        $this->remainingCards = $this->allCards;
    }

    public function getAllCards(): array
    {
        return $this->allCards;
    }

    public function getCards(): array
    {
        return $this->remainingCards;
    }

    public function shuffleCards(): array
    {
        $this->remainingCards = $this->allCards;
        shuffle($this->remainingCards);
        return $this->getCards();
    }

    public function drawCard(int $nrOfCards): array
    {
        $usedCards = [];
        for ($x = 0; $x < $nrOfCards; $x++) {
            array_push($usedCards, array_pop($this->remainingCards));
        }
        return $usedCards;
    }

    public function cardsLeft(): int
    {
        return count($this->remainingCards);
    }
}
