<?php

namespace App\Entity;

use App\Repository\RelatedPatentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelatedPatentsRepository::class)]
class RelatedPatents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ThisPatentReferences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $PrimaryPatent = null;

    #[ORM\ManyToOne(inversedBy: 'PatentReferencedBy')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $RelatedPatent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $RelationshipType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Comments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimaryPatent(): ?Patent
    {
        return $this->PrimaryPatent;
    }

    public function setPrimaryPatent(?Patent $PrimaryPatent): static
    {
        $this->PrimaryPatent = $PrimaryPatent;

        return $this;
    }

    public function getRelatedPatent(): ?Patent
    {
        return $this->RelatedPatent;
    }

    public function setRelatedPatent(?Patent $RelatedPatent): static
    {
        $this->RelatedPatent = $RelatedPatent;

        return $this;
    }

    public function getRelationshipType(): ?string
    {
        return $this->RelationshipType;
    }

    public function setRelationshipType(?string $RelationshipType): static
    {
        $this->RelationshipType = $RelationshipType;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->Comments;
    }

    public function setComments(?string $Comments): static
    {
        $this->Comments = $Comments;

        return $this;
    }

}
