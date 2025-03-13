<?php

namespace App\Entity;

use App\Repository\DatesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DatesRepository::class)]
class Dates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateShort = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateLong = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $GracePeriod = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DateTypes $DatesHaveTypes = null;

    #[ORM\ManyToOne(inversedBy: 'PatentsHaveDates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patent $PatentID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateShort(): ?\DateTimeInterface
    {
        return $this->DateShort;
    }

    public function setDateShort(?\DateTimeInterface $DateShort): static
    {
        $this->DateShort = $DateShort;

        return $this;
    }

    public function getDateLong(): ?\DateTimeInterface
    {
        return $this->DateLong;
    }

    public function setDateLong(?\DateTimeInterface $DateLong): static
    {
        $this->DateLong = $DateLong;

        return $this;
    }

    public function getGracePeriod(): ?\DateTimeInterface
    {
        return $this->GracePeriod;
    }

    public function setGracePeriod(?\DateTimeInterface $GracePeriod): static
    {
        $this->GracePeriod = $GracePeriod;

        return $this;
    }

    public function getDatesHaveTypes(): ?DateTypes
    {
        return $this->DatesHaveTypes;
    }

    public function setDatesHaveTypes(?DateTypes $DatesHaveTypes): static
    {
        $this->DatesHaveTypes = $DatesHaveTypes;

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
