<?php

namespace App\Entity;

use App\Repository\InventorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventorRepository::class)]
class Inventor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PhoneNumber = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $PassHash = null;

    #[ORM\ManyToOne]
    private ?PersonType $InventorIsPersonType = null;

    /**
     * @var Collection<int, Patent>
     */
    #[ORM\ManyToMany(targetEntity: Patent::class, inversedBy: 'Inventors')]
    private Collection $InventorsHavePatents;

    public function __construct()
    {
        $this->InventorsHavePatents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): static
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?string $PhoneNumber): static
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getPassHash(): ?string
    {
        return $this->PassHash;
    }

    public function setPassHash(?string $PassHash): static
    {
        $this->PassHash = $PassHash;

        return $this;
    }

    public function getInventorIsPersonType(): ?PersonType
    {
        return $this->InventorIsPersonType;
    }

    public function setInventorIsPersonType(?PersonType $InventorIsPersonType): static
    {
        $this->InventorIsPersonType = $InventorIsPersonType;

        return $this;
    }

    /**
     * @return Collection<int, Patent>
     */
    public function getInventorsHavePatents(): Collection
    {
        return $this->InventorsHavePatents;
    }

    public function addInventorsHavePatent(Patent $inventorsHavePatent): static
    {
        if (!$this->InventorsHavePatents->contains($inventorsHavePatent)) {
            $this->InventorsHavePatents->add($inventorsHavePatent);
        }

        return $this;
    }

    public function removeInventorsHavePatent(Patent $inventorsHavePatent): static
    {
        $this->InventorsHavePatents->removeElement($inventorsHavePatent);

        return $this;
    }

}
