<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckWith2Jokers.
 */
class DeckWith2JokersTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $deck2Obj = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck2Obj);
    }

    /**
     * Tests that the jokers are added to the deck.
     */
    public function testAddJokers()
    {
        $deck2Obj = new DeckWith2Jokers();
        $deck2Obj->addJokers();
        $getAllCards = $deck2Obj->getAllCards();
        $this->assertEquals(54, count($getAllCards));
        $this->assertContainsOnlyInstancesOf("\App\Card\Card", $getAllCards);
        $this->assertEquals("\u{1F0BF} JO", $getAllCards[52]->getCard());
    }
}
