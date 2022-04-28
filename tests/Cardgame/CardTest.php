<?php

namespace App\Card;

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
        $cardObj = new Card("\u{2665}", 3);
        $cardObj2 = new Card("\u{2663}", "K");
        $this->assertInstanceOf("\App\Card\Card", $cardObj);
        $this->assertInstanceOf("\App\Card\Card", $cardObj2);
    }

    /**
     * Tests that the method returns a string of card information
     */
    public function testGetCard()
    {
        $cardObj = new Card("\u{2665}", 3);
        $res = $cardObj->getCard();
        $cardObj2 = new Card("\u{2663}", "K");
        $res2 = $cardObj2->getCard();
        $this->assertEquals("\u{2665} 3", $res);
        $this->assertEquals("\u{2663} K", $res2);
    }
}
