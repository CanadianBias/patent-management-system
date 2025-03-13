<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Stat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStat(): ?string
    {
        return $this->Stat;
    }

    public function setStat(string $Stat): static
    {
        $this->Stat = $Stat;

        return $this;
    }
}
