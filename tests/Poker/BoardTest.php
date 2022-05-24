<?php

namespace App\Poker;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Board.
 */
class BoardTest extends TestCase
{
    /**
     * Construct object and verify that the object is of expected instance.
     */
    public function testCreate()
    {
        $board = new Board();
        $this->assertInstanceOf("\App\Poker\Board", $board);
    }

    /**
     * Tests that the method returns the board and that the board
     * has the correct length
     */
    public function testGetBoard()
    {
        $board = new Board();
        $getBoard = $board->getBoard();
        $this->assertIsArray($getBoard);
        $this->assertEquals(25, count($getBoard));
    }

    /**
     * Test to add a card to the board on boxid 10 and
     * sees that the board is updated
     */
    public function testAddCard()
    {
        $card = new Card("\u{2665}", "Q", "red", 12);
        $board = new Board();
        $board->addCard(10, $card);
        $getBoard = $board->getBoard();
        $this->assertInstanceOf("\App\Poker\Card", $getBoard[10]);
        $this->assertEquals("\u{2665} Q", $getBoard[10]->getCard());
    }

    /**
     * Adds a card on boxid 18 and checks that it is marked
     * as a selected box
     */
    public function testGetSelectedBoxes()
    {
        $card = new Card("\u{2665}", 5, "red", 5);
        $board = new Board();
        $board->addCard(18, $card);
        $selectedBoxes = $board->getSelectedBoxes();
        $this->assertIsArray($selectedBoxes);
        $this->assertContains(18, $selectedBoxes);
        // $this->assertEquals([18], $selectedBoxes);
    }

    /**
     * Tests that the number is updated when a box is selected
     */
    public function testCountSelectedBoxes()
    {
        $card = new Card("\u{2665}", 5, "red", 5);
        $board = new Board();
        $counterBefore = $board->countSelectedBoxes();
        $board->addCard(18, $card);
        $counterAfter = $board->countSelectedBoxes();
        $this->assertEquals(0, $counterBefore);
        $this->assertEquals(1, $counterAfter);
    }

    /**
     * Fills the board with cards. then calls the method
     * where hands are created. Then calls the method
     * calculates how many points each hand gives.
     * Tests that the score is what is excepted.
     */
    public function testGetScore()
    {
        $board = new Board();
        $deck = new Deck();

        for ($nr = 0; $nr <= 24; $nr++) {
            $board->addCard($nr, $deck->drawCard());
        }

        $board->setHands();
        $getScore = $board->getScore();
        $this->assertEquals(325, $getScore);
    }

    /**
     * Fills the board with cards. Then calls the method
     * where hands are created. Then calls the method
     * calculates how many points each hand gives,
     * tests that the checkWin method returns what is excepted.
     */
    public function testCheckWin()
    {
        $board = new Board();
        $deck = new Deck();

        for ($nr = 0; $nr <= 24; $nr++) {
            $board->addCard($nr, $deck->drawCard());
        }

        $board->setHands();
        $checkWin = $board->checkWin();
        $this->assertEquals("Du vann!", $checkWin);
    }

    /**
     * Tests the bool variable if the game is over or not
     */
    public function testRoundIsEnd()
    {
        $board = new Board();
        $isEndBefore = $board->roundIsEnd();
        $deck = new Deck();

        for ($nr = 0; $nr <= 24; $nr++) {
            $board->addCard($nr, $deck->drawCard());
        }

        $board->setHands();
        $isEndAfter = $board->roundIsEnd();
        $this->assertEquals(false, $isEndBefore);
        $this->assertEquals(true, $isEndAfter);
    }
}
