<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $deckObj = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deckObj);
    }

    /**
     * Tests that the method contains card objects
     */
    public function testGetAllCards()
    {
        $deckObj = new Deck();
        $cardArray = $deckObj->getAllCards();
        $this->assertInstanceOf("\App\Card\Card", $cardArray[10]);
        $this->assertIsArray($cardArray);
        $this->assertEquals(52, count($cardArray));
        $this->assertContainsOnlyInstancesOf("\App\Card\Card", $cardArray);
        $this->assertEquals("\u{2665} Q", $cardArray[10]->getCard());
    }

    /**
     * Test to shuffle all cards and then draw different nr of cards
     */
    public function testDrawCards()
    {
        $deckObj = new Deck();
        $cardArray = $deckObj->shuffleCards();
        $deckObj->drawCard(1);
        $cardArray2 = $deckObj->getCards();
        $this->assertEquals(52, count($cardArray));
        $this->assertEquals(51, count($cardArray2));
        $drawnCards = $deckObj->drawCard(15);
        $cardArray3 = $deckObj->getCards();
        $this->assertEquals(36, count($cardArray3));
        $this->assertContainsOnlyInstancesOf("\App\Card\Card", $drawnCards);
    }

    /**
     * Tests that drawn cards are removed from the sum of cards
     */
    public function testCardsLeft()
    {
        $deckObj = new Deck();
        $cardsLeft = $deckObj->cardsLeft();
        $deckObj->drawCard(15);
        $cardsLeft2 = $deckObj->cardsLeft();
        $this->assertEquals(52, $cardsLeft);
        $this->assertEquals(37, $cardsLeft2);
    }
}
