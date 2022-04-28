<?php

namespace App\Card;

use App\Controller;

class Game
{
    private object $deck;
    private object $player;
    private object $computer;
    private int $playerSum;
    private int $computerSum;

    public function __construct(object $deck, object $player, object $computer)
    {
        $this->deck = $deck;
        $this->player = $player;
        $this->computer = $computer;
        $this->playerSum = 0;
        $this->computerSum = 0;
        $this->deck->shuffleCards();
    }

    public function drawCard(int $playerId): object
    {
        $drawnCard = $this->deck->drawCard(1);
        if ($playerId == 1) {
            array_push($this->player->hand, $drawnCard[0]);
            $this->addToPlayerSum($drawnCard[0]->value);
            return $drawnCard[0];
        }
        array_push($this->computer->hand, $drawnCard[0]);
        $this->addToComputerSum($drawnCard[0]->value);
        return $drawnCard[0];
    }

    private function addToPlayerSum(int|string $cardValue): void
    {
        if ($cardValue == "J") {
            $this->playerSum += 11;
        } elseif ($cardValue == "Q") {
            $this->playerSum += 12;
        } elseif ($cardValue == "K") {
            $this->playerSum += 13;
        } elseif ($cardValue == "A") {
            if ($this->getPlayerSum() < 8) {
                $this->playerSum += 14;
            } elseif ($this->getPlayerSum() >= 8) {
                $this->playerSum += 1;
            }
        } else {
            $this->playerSum += $cardValue;
        }
    }

    private function addToComputerSum(int|string $cardValue): void
    {
        if ($cardValue == "J") {
            $this->computerSum += 11;
        } elseif ($cardValue == "Q") {
            $this->computerSum += 12;
        } elseif ($cardValue == "K") {
            $this->computerSum += 13;
        } elseif ($cardValue == "A") {
            if ($this->getComputerSum() < 8) {
                $this->computerSum += 14;
            } elseif ($this->getComputerSum() >= 8) {
                $this->computerSum += 1;
            }
        } else {
            $this->computerSum += $cardValue;
        }
    }

    private function checkWinner(): string
    {
        if ($this->getComputerSum() > 21 || $this->getComputerSum() < $this->getPlayerSum()) {
            return "Spelaren vann!";
        }
        return "Banken vann!";
    }

    public function computerDraw(): string
    {
        while ($this->getComputerSum() < 17) {
            $this->drawCard(2);
        }
        return $this->checkWinner();
    }

    public function checkWinDirect(): bool
    {
        return ($this->getPlayerSum() > 21);
    }

    public function resetGame(): void
    {
        $this->deck = new Deck();
        $this->player = new Player(1, []);
        $this->playerSum = 0;
        $this->computer = new Player(2, []);
        $this->computerSum = 0;
        $this->deck->shuffleCards();
    }

    public function getPlayerSum(): int
    {
        return $this->playerSum;
    }

    public function getComputerSum(): int
    {
        return $this->computerSum;
    }

    public function getPlayerHand(): array
    {
        return $this->player->hand;
    }

    public function getComputerHand(): array
    {
        return $this->computer->hand;
    }
}
