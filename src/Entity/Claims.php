<?php

namespace App\Entity;

use App\Repository\ClaimsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClaimsRepository::class)]
class Claims
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $Claim = null;

    #[ORM\ManyToOne(inversedBy: 'PatentsHaveClaims')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $PatentID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClaim(): ?string
    {
        return $this->Claim;
    }

    public function setClaim(string $Claim): static
    {
        $this->Claim = $Claim;

        return $this;
    }

    public function getPatentID(): ?Patent
    {
        return $this->PatentID;
    }

    public function setPatentID(?Patent $PatentID): static
    {
        $this->PatentID = $PatentID;

        return $this;
    }
}
