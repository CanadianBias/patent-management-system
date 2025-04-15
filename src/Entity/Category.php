<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

// Patents are generally put into three to four categories by the US Patent Office,
// depending on the contents or the status of the patent.
// More categories exist and may be added in the future, but these are the most common.

// This entity is autofilled in the migrations.

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
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

    // Category of the patent, using the field Type to avoid naming confusion
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
