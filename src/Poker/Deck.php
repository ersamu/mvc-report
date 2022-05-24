<?php

namespace App\Poker;

use App\Controller;

/**
 * A deck of cards
 */
class Deck
{
    private array $cards;
    private array $allSuites = ["\u{2665}", "\u{2666}", "\u{2660}", "\u{2663}"];
    private array $allValues = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
    private array $allColors;
    private array $drawnCards;

    /**
     * The constructor prepares the array for cards and drawn cards,
     * uses array functions to create an array with the color of the cards,
     * and calls the method for adding card objects
     */
    public function __construct()
    {
        $this->cards = [];
        $this->drawnCards = [];
        $this->allColors = array_merge(array_fill(0, 26, "red"), array_fill(0, 26, "black"));
        $this->addCards();
    }

    /**
     * Adds 52 card objects that have suite, value, color and value in numbers
     */
    private function addCards()
    {
        $counter = 0;
        foreach ($this->allSuites as $suit) {
            foreach ($this->allValues as $value) {
                if ($value === "J") {
                    array_push($this->cards, new Card($suit, $value, $this->allColors[$counter], 11));
                } elseif ($value === "Q") {
                    array_push($this->cards, new Card($suit, $value, $this->allColors[$counter], 12));
                } elseif ($value === "K") {
                    array_push($this->cards, new Card($suit, $value, $this->allColors[$counter], 13));
                } elseif ($value === "A") {
                    array_push($this->cards, new Card($suit, $value, $this->allColors[$counter], 1));
                } elseif (gettype($value) === "integer") {
                    array_push($this->cards, new Card($suit, $value, $this->allColors[$counter], $value));
                }
                $counter += 1;
            }
        }
    }

    /**
     * @return array array with cards
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Shuffles all cards
     */
    public function shuffleCards()
    {
        shuffle($this->cards);
    }

    /**
     * Draws a card and adds it to the array of drawn cards
     * @return object a random card
     */
    public function drawCard(): object
    {
        $card = array_pop($this->cards);
        array_push($this->drawnCards, $card);
        return $card;
    }

    /**
     * @return object|null the last drawn card
     */
    public function lastDrawnCard(): object|null
    {
        if ($this->drawnCards) {
            return end($this->drawnCards);
        }
        return null;
    }

    /**
     * @return int the number of cards drawn
     */
    public function nrOfDrawnCards(): int
    {
        return count($this->drawnCards);
    }
}
