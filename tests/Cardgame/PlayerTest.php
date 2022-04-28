<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $playerObj = new Player(1, []);
        $deckObj = new Deck();
        $deckObj->shuffleCards();
        $drawnCards = $deckObj->drawCard(2);
        $playerObj2 = new Player(2, $drawnCards);
        $this->assertInstanceOf("\App\Card\Player", $playerObj);
        $this->assertInstanceOf("\App\Card\Player", $playerObj2);
    }
}
