<?php

namespace App\Entity;

use App\Repository\DateTypesRepository;
use Doctrine\ORM\Mapping as ORM;

// With respect to the US Patent Office, dates have a specific meaning tied to them
// Here, the DateTypes entity defines what type of date a Dates entity is

// Each date can have one DateType, but a DateType can have multiple dates
// This relationship is only seen by the Dates entity, so there is no corresponding collection in this entity

// This entity is autofilled in the migrations

#[ORM\Entity(repositoryClass: DateTypesRepository::class)]
class DateTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // String defining the type of date
    #[ORM\Column(length: 255)]
    private ?string $DateType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateType(): ?string
    {
        return $this->DateType;
    }

    public function setDateType(string $DateType): static
    {
        $this->DateType = $DateType;

        return $this;
    }
}
