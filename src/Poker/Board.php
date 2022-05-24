<?php

namespace App\Poker;

use App\Controller;

/**
 * The "board" where we have all 25 "boxes"
 * where the cards are to be placed
 */
class Board
{
    private array $board;
    private array $selectedBoxes;
    private object $hand1;
    private object $hand2;
    private object $hand3;
    private object $hand4;
    private object $hand5;
    private object $hand6;
    private object $hand7;
    private object $hand8;
    private object $hand9;
    private object $hand10;
    private int $score;
    private bool $isEnd;

    /**
     * The constructor sets 0 as score, blank arrays for board and
     * selected boxes, if the game isEnd to false, calls the method
     * of filling the board
     */
    public function __construct()
    {
        $this->score = 0;
        $this->board = [];
        $this->selectedBoxes = [];
        $this->isEnd = false;
        $this->setBoard();
    }

    /**
     * Set the board with 25 empty strings
     */
    private function setBoard()
    {
        for ($nr = 0; $nr <= 24; $nr++) {
            array_push($this->board, "");
        }
    }

    /**
     * @return array all boxes
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * Inserts the card into the array of the user-selected box,
     * adds to the array selectedBoxes that the box is selected
     * @param int $boxId the box
     * @param object $card the card
     */
    public function addCard(int $boxId, object $card)
    {
        array_push($this->selectedBoxes, $boxId);
        $this->board[$boxId] = $card;
    }

    /**
     * @return array all selected boxes
     */
    public function getSelectedBoxes(): array
    {
        return $this->selectedBoxes;
    }

    /**
     * @return int the number of selected boxes
     */
    public function countSelectedBoxes(): int
    {
        return count($this->selectedBoxes);
    }

    /**
     * Creates 10 hand objects with five card objects,
     * which are the player's hands, calls the method
     * that adds points for each hand. Calling this method
     * means that the round is over, isEnd is set to true.
     */
    public function setHands()
    {
        $this->isEnd = true;
        $this->hand1 = new Hand([$this->board[0], $this->board[1], $this->board[2], $this->board[3],
        $this->board[4]]);
        $this->hand2 = new Hand([$this->board[5], $this->board[6], $this->board[7], $this->board[8],
        $this->board[9]]);
        $this->hand3 = new Hand([$this->board[10], $this->board[11], $this->board[12], $this->board[13],
        $this->board[14]]);
        $this->hand4 = new Hand([$this->board[15], $this->board[16], $this->board[17], $this->board[18],
        $this->board[19]]);
        $this->hand5 = new Hand([$this->board[20], $this->board[21], $this->board[22], $this->board[23],
        $this->board[24]]);
        $this->hand6 = new Hand([$this->board[0], $this->board[5], $this->board[10], $this->board[15],
        $this->board[20]]);
        $this->hand7 = new Hand([$this->board[1], $this->board[6], $this->board[11], $this->board[16],
        $this->board[21]]);
        $this->hand8 = new Hand([$this->board[2], $this->board[7], $this->board[12], $this->board[17],
        $this->board[22]]);
        $this->hand9 = new Hand([$this->board[3], $this->board[8], $this->board[13], $this->board[18],
        $this->board[23]]);
        $this->hand10 = new Hand([$this->board[4], $this->board[9], $this->board[14], $this->board[19],
        $this->board[24]]);
        $this->setScore();
    }

    /**
     * Adds points for the hands
     */
    private function setScore()
    {
        $this->score += $this->hand1->checkRules();
        $this->score += $this->hand2->checkRules();
        $this->score += $this->hand3->checkRules();
        $this->score += $this->hand4->checkRules();
        $this->score += $this->hand5->checkRules();
        $this->score += $this->hand6->checkRules();
        $this->score += $this->hand7->checkRules();
        $this->score += $this->hand8->checkRules();
        $this->score += $this->hand9->checkRules();
        $this->score += $this->hand10->checkRules();
    }

    /**
     * @return int player's score for a round
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string information about the user won
     * or lost their bet money
     */
    public function checkWin(): string
    {
        if ($this->getScore() >= 200) {
            return "Du vann!";
        }
        return "Du förlorade!";
    }

    /**
     * @return bool if the round is over or not
     */
    public function roundIsEnd(): bool
    {
        return $this->isEnd;
    }
}
