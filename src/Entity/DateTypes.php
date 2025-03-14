<?php

namespace App\Entity;

use App\Repository\DateTypesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateTypesRepository::class)]
class DateTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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
