<?php

namespace App\Card;

class DeckWith2Jokers extends Deck
{
    public function addJokers()
    {
        for ($x = 0; $x < 2; $x++) {
            array_push($this->allCards, new \App\Card\Card("\u{1F0BF}", "JO"));
        }
    }
}
