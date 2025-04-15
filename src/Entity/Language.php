<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

// Patents are written and published in a language
// In business logic, it might make sense for this to be a many-to-many relationship
// as a patent can be translated and published in many languages. For the scope of the project,
// it made more sense to make this a ManyToOne relationship as the application only has English support

// This entity is autofilled in the migrations

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // This is the ISO 3-letter code for the language
    #[ORM\Column(length: 3)]
    private ?string $Code = null;

    // This is the full ISO name of the language or language group
    #[ORM\Column(length: 255)]
    private ?string $Name = null;

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

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }
}
