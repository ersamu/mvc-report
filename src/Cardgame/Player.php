<?php

namespace App\Card;

class Player
{
    public int $playerId;
    public array $hand;

    public function __construct(int $playerId, array $hand)
    {
        $this->playerId = $playerId;
        $this->hand = $hand;
    }
}
