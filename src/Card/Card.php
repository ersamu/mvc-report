<?php

namespace App\Card;

/**
 * A playing card
 */
class Card
{
    private string $suit;
    public int|string $value;

    /**
     * The constructor sets the color and value of the card
     * @param string $suit suit of the card
     * @param int|string $value value of the card
     */
    public function __construct(string $suit, int|string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * @return string information about the suit and value of the card
     */
    public function getCard(): string
    {
        return "{$this->suit} {$this->value}";
    }
}
