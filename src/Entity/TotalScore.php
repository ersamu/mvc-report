<?php

namespace App\Entity;

use App\Repository\TotalScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
#[ORM\Entity(repositoryClass: TotalScoreRepository::class)]
class TotalScore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** @phpstan-ignore-next-line */
    private $id;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score += $score;

        return $this;
    }

    public function resetScore(): self
    {
        $this->score = 0;

        return $this;
    }
}
