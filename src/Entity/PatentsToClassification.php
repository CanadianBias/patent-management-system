<?php

namespace App\Entity;

use App\Repository\PatentsToClassificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatentsToClassificationRepository::class)]
class PatentsToClassification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ClassificationType = null;

    #[ORM\ManyToOne(inversedBy: 'ClassificationsList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $Patent = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classification $Classification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassificationType(): ?string
    {
        return $this->ClassificationType;
    }

    public function setClassificationType(string $ClassificationType): static
    {
        $this->ClassificationType = $ClassificationType;

        return $this;
    }

    public function getPatent(): ?Patent
    {
        return $this->Patent;
    }

    public function setPatent(?Patent $Patent): static
    {
        $this->Patent = $Patent;

        return $this;
    }

    public function getClassification(): ?Classification
    {
        return $this->Classification;
    }

    public function setClassification(?Classification $Classification): static
    {
        $this->Classification = $Classification;

        return $this;
    }
}
