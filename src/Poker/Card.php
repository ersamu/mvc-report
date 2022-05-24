<?php

namespace App\Poker;

/**
 * A playing card
 */
class Card
{
    private string $suit;
    private int|string $value;
    private string $color;
    private int $valueNr;

    /**
     * The constructor sets the suit, color and value of the card
     * @param string $suit suit of the card
     * @param int|string $value value of the card
     * @param string $color color of the card
     * @param int $valueNr value of the card in numbers
     */
    public function __construct(string $suit, int|string $value, string $color, int $valueNr)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->color = $color;
        $this->valueNr = $valueNr;
    }

    /**
     * @return string information about the suit and value of the card
     */
    public function getCard(): string
    {
        return "{$this->suit} {$this->value}";
    }

    /**
     * @return string the suit of the card
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * @return int the value of the card in numbers
     */
    public function getValueNr(): int
    {
        return $this->valueNr;
    }

    /**
     * @return string the color of the card
     */
    public function getColor(): string
    {
        return $this->color;
    }
}
