<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Filename = null;

    #[ORM\ManyToOne(inversedBy: 'Files')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $patent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->Filename;
    }

    public function setFilename(string $Filename): static
    {
        $this->Filename = $Filename;

        return $this;
    }

    public function getPatent(): ?Patent
    {
        return $this->patent;
    }

    public function setPatent(?Patent $patent): static
    {
        $this->patent = $patent;

        return $this;
    }
}
