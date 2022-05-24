<?php

namespace App\Poker;

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
        $deck = new Deck();
        $this->assertInstanceOf("\App\Poker\Deck", $deck);
    }

    /**
     * Tests that the method returns array with all cards
     */
    public function testGetCards()
    {
        $deck = new Deck();
        $cards = $deck->getCards();
        $this->assertInstanceOf("\App\Poker\Card", $cards[30]);
        $this->assertIsArray($cards);
        $this->assertEquals(52, count($cards));
        $this->assertContainsOnlyInstancesOf("\App\Poker\Card", $cards);
        $this->assertEquals("\u{2660} 6", $cards[30]->getCard());
    }

    /**
     * Test to draw one card, check that the length of the array
     * with all card decreases
     */
    public function testDrawCard()
    {
        $deck = new Deck();
        $cardsBefore = $deck->getCards();
        $card = $deck->drawCard();
        $cardsAfter = $deck->getCards();
        $this->assertEquals(52, count($cardsBefore));
        $this->assertEquals(51, count($cardsAfter));
        $this->assertInstanceOf("\App\Poker\Card", $card);
        $this->assertEquals("\u{2663} A", $card->getCard());
    }
    
    /**
     * Tests the method that returns the last drawn card or null
     */
    public function testLastDrawnCard()
    {
        $deck = new Deck();
        $hopefullyNull = $deck->lastDrawnCard();
        $deck->drawCard();
        $deck->drawCard();
        $lastCard = $deck->lastDrawnCard();
        $this->assertNull($hopefullyNull);
        $this->assertInstanceOf("\App\Poker\Card", $lastCard);
        $this->assertEquals("\u{2663} K", $lastCard->getCard());
    }

    /**
     * Tests that the number of drawn cards is updated
     */
    public function testNrOfDrawnCards()
    {
        $deck = new Deck();
        $beforeDraw = $deck->nrOfDrawnCards();
        $deck->drawCard();
        $deck->drawCard();
        $afterDraw = $deck->nrOfDrawnCards();
        $this->assertEquals(0, $beforeDraw);
        $this->assertEquals(2, $afterDraw);
    }
}
