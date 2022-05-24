<?php

namespace App\Poker;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $card = new Card("\u{2666}", 6, "red", 6);
        $card2 = new Card("\u{2660}", "D", "black", 12);
        $this->assertInstanceOf("\App\Poker\Card", $card);
        $this->assertInstanceOf("\App\Poker\Card", $card2);
    }

    /**
     * Tests that the method returns a string of card information
     */
    public function testGetCard()
    {
        $card = new Card("\u{2665}", "A", "red", 1);
        $infoCard = $card->getCard();
        $card2 = new Card("\u{2663}", 2, "black", 2);
        $infoCard2 = $card2->getCard();
        $this->assertEquals("\u{2665} A", $infoCard);
        $this->assertEquals("\u{2663} 2", $infoCard2);
    }

    /**
     * Tests that the method returns the suit of the card
     */
    public function testGetSuit()
    {
        $card = new Card("\u{2665}", "A", "red", 1);
        $suit = $card->getSuit();
        $card2 = new Card("\u{2663}", 2, "black", 2);
        $suit2 = $card2->getSuit();
        $this->assertEquals("\u{2665}", $suit);
        $this->assertEquals("\u{2663}", $suit2);
    }

        /**
     * Tests that the method returns the valueNr of the card
     */
    public function testGetValueNr()
    {
        $card = new Card("\u{2665}", "A", "red", 1);
        $valueNr = $card->getValueNr();
        $card2 = new Card("\u{2663}", 2, "black", 2);
        $valueNr2 = $card2->getValueNr();
        $this->assertEquals(1, $valueNr);
        $this->assertEquals(2, $valueNr2);
    }

    /**
     * Tests that the metod returns the correct color of the card
     */
    public function testGetColor()
    {
        $card = new Card("\u{2665}", "A", "red", 1);
        $color = $card->getColor();
        $card2 = new Card("\u{2663}", 2, "black", 2);
        $color2 = $card2->getColor();
        $this->assertEquals("red", $color);
        $this->assertEquals("black", $color2);
    }
}
