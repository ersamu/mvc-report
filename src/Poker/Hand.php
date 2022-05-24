<?php

namespace App\Poker;

use App\Controller;

/**
 * Hand with five cards
 */
class Hand
{
    private array $hand;
    private array $handValues;
    private array $valueCounter;

    /**
     * @param array $hand
     * The constructor receives an array of five card objects
     * that form a hand, prepares array to save all card values
     * in numbers and sets the array value counter
     */
    public function __construct($hand)
    {
        $this->hand = $hand;
        $this->handValues = [];
        $this->valueCounter = [];
    }

    /**
     * Saves all the value of the cards in numbers in an array
     */
    private function setHandValues()
    {
        foreach ($this->hand as $card) {
            array_push($this->handValues, $card->getValueNr());
        }
    }

    /**
     * Count all the values in the array
     */
    private function setValueCounter()
    {
        $this->valueCounter = array_count_values($this->handValues);
    }

    /**
     * Calls the method that saves all card values in numbers in an
     * array, sorts the array. Then calls the method that saves how
     * many times all values are in the hand. Then call methods for
     * each rule and see how many points it will be for the hand.
     * Divided into two methods for the complexity.
     * @return int the value of the hand in points
     */
    public function checkRules(): int
    {
        $this->setHandValues();
        sort($this->handValues);
        $this->setValueCounter();
        if ($this->royalFlush()) {
            return 100;
        } if ($this->straightFlush()) {
            return 75;
        } if ($this->fourOfAKind()) {
            return 50;
        } if ($this->fullHouse()) {
            return 25;
        } if ($this->flushRule()) {
            return 20;
        } return $this->lowerRules();
    }

    /**
     * Calls the method that saves all card values in numbers in an
     * array, sorts the array. Then calls the method that saves how
     * many times all values are in the hand. Then call methods for
     * each rule and see how many points it will be for the hand.
     * Divided into two methods for the complexity.
     * @return int the value of the hand in points
     */
    private function lowerRules()
    {
        if ($this->straight()) {
            return 15;
        } if ($this->threeOfAKind()) {
            return 10;
        } if ($this->twoPairs()) {
            return 5;
        } if ($this->onePair()) {
            return 2;
        }
        return 0;
    }

    /**
     * @return bool check if there will be points for one pair
     */
    private function onePair(): bool
    {
        foreach ($this->valueCounter as $count) {
            if ($count === 2) {
                return true;
            };
        }
        return false;
    }

    /**
     * @return bool check if there will be points for two pairs
     */
    private function twoPairs(): bool
    {
        $counterPairs = 0;

        foreach ($this->valueCounter as $count) {
            if ($count === 2) {
                $counterPairs += 1;
            };
        }

        if ($counterPairs === 2) {
            return true;
        }
        return false;
    }

    /**
     * @return bool check if there will be points for three of a kind
     */
    private function threeOfAKind(): bool
    {
        foreach ($this->valueCounter as $count) {
            if ($count === 3) {
                return true;
            };
        }
        return false;
    }

    /**
     * @return bool check if there will be points for straight
     */
    private function straight(): bool
    {
        if ($this->handValues === [1, 10, 11, 12, 13]) {
            return true;
        }
        for ($card = 0; $card < 4; $card++) {
            if ($this->handValues[$card + 1] !== $this->handValues[$card] + 1) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool check if there will be points for flush
     */
    private function flushRule(): bool
    {
        $handColors = [];
        foreach ($this->hand as $card) {
            array_push($handColors, $card->getSuit());
        }

        if (count(array_flip($handColors)) === 1) {
            return true;
        }
        return false;
    }

    /**
     * @return bool check if there will be points for full house
     */
    private function fullHouse(): bool
    {
        $first = $this->handValues[0] === $this->handValues[1];
        $last = $this->handValues[3] === $this->handValues[4];
        $leftMiddle = $this->handValues[1] === $this->handValues[2];
        $rightMiddle = $this->handValues[2] === $this->handValues[3];

        if ($first && $last) {
            if ($leftMiddle || $rightMiddle) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool check if there will be points for four of a kind
     */
    private function fourOfAKind(): bool
    {
        foreach ($this->valueCounter as $count) {
            if ($count === 4) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool check if there will be points for straight flush
     */
    private function straightFlush(): bool
    {
        if ($this->straight() && $this->flushRule()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool check if there will be points for royal flush
     */
    private function royalFlush(): bool
    {
        if ($this->handValues === [1, 10, 11, 12, 13] && $this->flushRule()) {
            return true;
        }
        return false;
    }
}
