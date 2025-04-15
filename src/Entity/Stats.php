<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

// Status is a reserved word within SQL, so the Stats entity name is used instead
// This entity stores the current status with the patent office

// This is autofilled in the migrations

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
