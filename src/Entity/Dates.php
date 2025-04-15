<?php

namespace App\Entity;

use App\Repository\DatesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Patents have a collection of dates associated with them, setting different deadlines with the patent office to
// ensure granting, renewal to the patent owner, and other important processes

#[ORM\Entity(repositoryClass: DatesRepository::class)]
class Dates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Due to my lack of business knowledge, I am not sure what the difference between short and long dates is
    // I think this has more to do with the type of date, but I included both here as date fields
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateShort = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateLong = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $GracePeriod = null;

    // Each date is defined by a type, which is defined in the DateTypes entity
    // Each date has one type, a date type can have many dates
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DateTypes $DatesHaveTypes = null;

    // This is a reference to the patent that this date is associated with
    // It is inversed by the PatentsHaveDates property in the Patent entity
    // Dates have one patent, each patent can have many dates
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
