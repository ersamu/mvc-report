<?php

namespace App\Poker;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Hand.
 */
class HandTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $card = new Card("\u{2665}", "Q", "red", 12);
        $card2 = new Card("\u{2666}", 7, "red", 7);
        $card3 = new Card("\u{2660}", "J", "black", 11);
        $card4 = new Card("\u{2660}", "A", "black", 1);
        $card5 = new Card("\u{2663}", "3", "black", 3);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $this->assertInstanceOf("\App\Poker\Hand", $hand);
    }

    /**
     * Tests a hand that should get points for royal flush
     */
    public function testCheckRules1()
    {
        $card = new Card("\u{2665}", "Q", "red", 12);
        $card2 = new Card("\u{2665}", 10, "red", 10);
        $card3 = new Card("\u{2665}", "J", "red", 11);
        $card4 = new Card("\u{2665}", "A", "red", 1);
        $card5 = new Card("\u{2665}", "K", "red", 13);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(100, $points);
    }

    /**
     * Tests a hand that should get points for straight flush
     */
    public function testCheckRules2()
    {
        $card = new Card("\u{2663}", 8, "black", 8);
        $card2 = new Card("\u{2663}", 10, "black", 10);
        $card3 = new Card("\u{2663}", 9, "black", 9);
        $card4 = new Card("\u{2663}", 7, "black", 7);
        $card5 = new Card("\u{2663}", "J", "black", 11);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(75, $points);
    }

    /**
     * Tests a hand that should get points for four of a kind
     */
    public function testCheckRules3()
    {
        $card = new Card("\u{2666}", "Q", "red", 12);
        $card2 = new Card("\u{2660}", 10, "black", 10);
        $card3 = new Card("\u{2660}", "Q", "black", 12);
        $card4 = new Card("\u{2665}", "Q", "red", 12);
        $card5 = new Card("\u{2663}", "Q", "black", 12);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(50, $points);
    }

    /**
     * Tests a hand that should get points for full house
     */
    public function testCheckRules4()
    {
        $card = new Card("\u{2663}", 3, "black", 3);
        $card2 = new Card("\u{2665}", 10, "red", 10);
        $card3 = new Card("\u{2660}", 3, "black", 3);
        $card4 = new Card("\u{2666}", 10, "red", 10);
        $card5 = new Card("\u{2663}", 10, "black", 10);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(25, $points);
    }

    /**
     * Tests a hand that should get points for flush
     */
    public function testCheckRules5()
    {
        $card = new Card("\u{2665}", "Q", "red", 12);
        $card2 = new Card("\u{2665}", 10, "red", 10);
        $card3 = new Card("\u{2665}", 3, "red", 3);
        $card4 = new Card("\u{2665}", 7, "red", 7);
        $card5 = new Card("\u{2665}", "A", "red", 1);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(20, $points);
    }

    /**
     * Tests a hand that should get points for straight
     */
    public function testCheckRules6()
    {
        $card = new Card("\u{2660}", 2, "black", 2);
        $card2 = new Card("\u{2660}", 4, "black", 4);
        $card3 = new Card("\u{2663}", 5, "black", 5);
        $card4 = new Card("\u{2666}", "A", "red", 1);
        $card5 = new Card("\u{2660}", 3, "black", 3);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(15, $points);
    }

    /**
     * Tests a hand that should get points for three of a kind
     */
    public function testCheckRules7()
    {
        $card = new Card("\u{2666}", "K", "red", 13);
        $card2 = new Card("\u{2663}", "K", "black", 13);
        $card3 = new Card("\u{2660}", "K", "black", 13);
        $card4 = new Card("\u{2665}", 5, "red", 5);
        $card5 = new Card("\u{2663}", 3, "black", 3);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(10, $points);
    }

    /**
     * Tests a hand that should get points for two pairs
     */
    public function testCheckRules8()
    {
        $card = new Card("\u{2663}", 3, "black", 3);
        $card2 = new Card("\u{2665}", 10, "red", 10);
        $card3 = new Card("\u{2660}", 7, "black", 7);
        $card4 = new Card("\u{2666}", 10, "red", 10);
        $card5 = new Card("\u{2663}", 7, "black", 7);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(5, $points);
    }

    /**
     * Tests a hand that should get points for one pair
     */
    public function testCheckRules9()
    {
        $card = new Card("\u{2666}", "K", "red", 13);
        $card2 = new Card("\u{2663}", 2, "black", 2);
        $card3 = new Card("\u{2660}", "K", "black", 13);
        $card4 = new Card("\u{2665}", 5, "red", 5);
        $card5 = new Card("\u{2663}", 3, "black", 3);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(2, $points);
    }

    /**
     * Tests a hand that should not give points
     */
    public function testCheckRules10()
    {
        $card = new Card("\u{2663}", 3, "black", 3);
        $card2 = new Card("\u{2665}", 7, "red", 7);
        $card3 = new Card("\u{2660}", 2, "black", 2);
        $card4 = new Card("\u{2666}", "A", "red", 1);
        $card5 = new Card("\u{2663}", 9, "black", 9);
        $hand = new Hand([$card, $card2, $card3, $card4, $card5]);
        $points = $hand->checkRules();
        $this->assertEquals(0, $points);
    }
}
