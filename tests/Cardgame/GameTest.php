<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $this->assertInstanceOf("\App\Card\Game", $gameObj);
    }

    /**
     * Testing to draw a card to a player
     */
    public function testDrawCards()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $drawnCard = $gameObj->drawCard(2);
        $this->assertInstanceOf("\App\Card\Card", $drawnCard);
    }

    /**
     * Testing to draw a card to the player & the method that return the
     * player hand so that drawn cards are added to the hand
     */
    public function testGetPlayerHand()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(1);
        $playerHand = $gameObj->getPlayerHand();
        $this->assertInstanceOf("\App\Card\Card", $playerHand[0]);
        $this->assertContainsOnlyInstancesOf("\App\Card\Card", $playerHand);
        $this->assertEquals(1, count($playerHand));
    }

    /**
     * Testing to draw a card to the computer & the method that return the
     * computer hand so that drawn cards are added to the hand
     */
    public function testGetComputerHand()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(2);
        $computerHand = $gameObj->getComputerHand();
        $this->assertInstanceOf("\App\Card\Card", $computerHand[0]);
        $this->assertContainsOnlyInstancesOf("\App\Card\Card", $computerHand);
        $this->assertEquals(1, count($computerHand));
    }

    /**
     * Testing to draw a card to the player & the method that return the
     * player sum so that drawn cards values are added to the sum
     */
    public function testGetPlayerSum()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(1);
        $playerSum = $gameObj->getPlayerSum();
        $this->assertGreaterThan(0, $playerSum);
    }

    /**
     * Testing to draw a card to the computer & the method that return the
     * computer sum so that drawn cards values are added to the sum
     */
    public function testGetComputerSum()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(2);
        $computerSum = $gameObj->getComputerSum();
        $this->assertGreaterThan(0, $computerSum);
    }

    /**
     * Tests that the game is reset with the method
     */
    public function testResetGame()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(1);
        $playerSum = $gameObj->getPlayerSum();
        $playerHand = $gameObj->getPlayerHand();
        $this->assertGreaterThan(0, $playerSum);
        $this->assertEquals(1, count($playerHand));
        $gameObj->resetGame();
        $playerSum = $gameObj->getPlayerSum();
        $playerHand = $gameObj->getPlayerHand();
        $this->assertEquals(0, $playerSum);
        $this->assertEquals(0, count($playerHand));
    }

    /**
     * Tests if the player's sum is over 21
     */
    public function testCheckWinDirect()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(1);
        $win = $gameObj->checkWinDirect();
        $this->assertEquals(false, $win);
        for ($d = 0; $d <= 10; $d++) {
            $gameObj->drawCard(1);
        }
        $win = $gameObj->checkWinDirect();
        $this->assertEquals(true, $win);
    }

    /**
     * Tests the computerDraw method and that the checkWinner method
     * returns correctly
     */
    public function testComputerDraw()
    {
        $gameObj = new Game(new Deck(), new Player(1, []), new Player(2, []));
        $gameObj->drawCard(2);
        $win = $gameObj->computerDraw();
        $this->assertStringContainsString("vann!", $win);
    }
}
