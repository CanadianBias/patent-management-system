<?php

namespace App\Entity;

use App\Repository\BusinessTypeRepository;
use Doctrine\ORM\Mapping as ORM;

// According to the North American Industry Classification System,
// Businesses are defined by a 6-digit code and title
// See https://www.census.gov/naics/ for more information

// It is important for the user to know the relationship between their patent and
// the business alignment of the company the patent corresponds to

// This entity is prefilled in the migrations

#[ORM\Entity(repositoryClass: BusinessTypeRepository::class)]
class BusinessType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // 6-digit NAICS alphanumeric code
    #[ORM\Column(length: 255)]
    private ?string $Code = null;

    // Title of the business classifcation
    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): static
    {
        $this->Code = $Code;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }
}
