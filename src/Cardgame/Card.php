<?php

namespace App\Card;

class Card
{
    private string $suit;
    public int|string $value;

    public function __construct(string $suit, int|string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getCard(): string
    {
        return "{$this->suit} {$this->value}";
    }
}
