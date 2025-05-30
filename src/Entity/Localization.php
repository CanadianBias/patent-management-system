<?php

namespace App\Entity;

use App\Repository\LocalizationRepository;
use Doctrine\ORM\Mapping as ORM;

// Patents are published in a geographical region and have a corresponding patent office
// As this project is being developed in the United States, International and USPC are the only options for now

// This entity is autofilled in the migrations

#[ORM\Entity(repositoryClass: LocalizationRepository::class)]
class Localization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }
}
