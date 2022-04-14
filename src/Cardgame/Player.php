<?php

namespace App\Card;

class Player
{
    public $playerId;
    public $hand;

    public function __construct($playerId, $hand)
    {
        $this->playerId = $playerId;
        $this->hand = $hand;
    }
}
