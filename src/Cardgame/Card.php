<?php

namespace App\Card;

class Card
{
    private $suit;
    private $value;

    public function __construct(string $suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getCard()
    {
        return "{$this->suit} {$this->value}";
    }
}
