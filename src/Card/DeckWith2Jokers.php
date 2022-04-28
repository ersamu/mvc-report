<?php

namespace App\Card;

use App\Controller;

class DeckWith2Jokers extends Deck
{
    public function addJokers(): void
    {
        for ($x = 0; $x < 2; $x++) {
            array_push($this->allCards, new Card("\u{1F0BF}", "JO"));
        }
    }
}
