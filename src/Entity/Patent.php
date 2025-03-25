<?php

namespace App\Entity;

use App\Repository\PatentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatentRepository::class)]
class Patent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, RelatedPatents>
     */
    #[ORM\OneToMany(targetEntity: RelatedPatents::class, mappedBy: 'PrimaryPatent', orphanRemoval: true)]
    private Collection $ThisPatentReferences;

    /**
     * @var Collection<int, RelatedPatents>
     */
    #[ORM\OneToMany(targetEntity: RelatedPatents::class, mappedBy: 'RelatedPatent', orphanRemoval: true)]
    private Collection $PatentReferencedBy;

    #[ORM\Column(length: 255)]
    private ?string $IRN = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PatentNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Title = null;

    #[ORM\Column(length: 1023, nullable: true)]
    private ?string $Descript = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $PatentsAreCategorized = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Localization $PatentsHaveLocalization = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $PatentsHaveLanguage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stats $PatentsHaveStatus = null;

    /**
     * @var Collection<int, PatentsToClassification>
     */
    #[ORM\OneToMany(targetEntity: PatentsToClassification::class, mappedBy: 'Patent', orphanRemoval: true)]
    private Collection $ClassificationsList;

    /**
     * @var Collection<int, Claims>
     */
    #[ORM\OneToMany(targetEntity: Claims::class, mappedBy: 'PatentID', orphanRemoval: true)]
    private Collection $PatentsHaveClaims;

    #[ORM\ManyToOne]
    private ?BusinessType $PatentHasBusinessType = null;

    /**
     * @var Collection<int, Dates>
     */
    #[ORM\OneToMany(targetEntity: Dates::class, mappedBy: 'PatentID', orphanRemoval: true)]
    private Collection $PatentsHaveDates;

    /**
     * @var Collection<int, Inventor>
     */
    #[ORM\ManyToMany(targetEntity: Inventor::class, inversedBy: 'patents')]
    private Collection $Inventors;

    public function __construct()
    {
        $this->ThisPatentReferences = new ArrayCollection();
        $this->PatentReferencedBy = new ArrayCollection();
        $this->ClassificationsList = new ArrayCollection();
        $this->PatentsHaveClaims = new ArrayCollection();
        $this->PatentsHaveDates = new ArrayCollection();
        $this->Inventors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, RelatedPatents>
     */
    public function getThisPatentReferences(): Collection
    {
        return $this->ThisPatentReferences;
    }

    public function addThisPatentReference(RelatedPatents $thisPatentReference): static
    {
        if (!$this->ThisPatentReferences->contains($thisPatentReference)) {
            $this->ThisPatentReferences->add($thisPatentReference);
            $thisPatentReference->setPrimaryPatent($this);
        }

        return $this;
    }

    public function removeThisPatentReference(RelatedPatents $thisPatentReference): static
    {
        if ($this->ThisPatentReferences->removeElement($thisPatentReference)) {
            // set the owning side to null (unless already changed)
            if ($thisPatentReference->getPrimaryPatent() === $this) {
                $thisPatentReference->setPrimaryPatent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RelatedPatents>
     */
    public function getPatentReferencedBy(): Collection
    {
        return $this->PatentReferencedBy;
    }

    public function addPatentReferencedBy(RelatedPatents $patentReferencedBy): static
    {
        if (!$this->PatentReferencedBy->contains($patentReferencedBy)) {
            $this->PatentReferencedBy->add($patentReferencedBy);
            $patentReferencedBy->setRelatedPatent($this);
        }

        return $this;
    }

    public function removePatentReferencedBy(RelatedPatents $patentReferencedBy): static
    {
        if ($this->PatentReferencedBy->removeElement($patentReferencedBy)) {
            // set the owning side to null (unless already changed)
            if ($patentReferencedBy->getRelatedPatent() === $this) {
                $patentReferencedBy->setRelatedPatent(null);
            }
        }

        return $this;
    }

    public function getIRN(): ?string
    {
        return $this->IRN;
    }

    public function setIRN(string $IRN): static
    {
        $this->IRN = $IRN;

        return $this;
    }

    public function getPatentNumber(): ?string
    {
        return $this->PatentNumber;
    }

    public function setPatentNumber(?string $PatentNumber): static
    {
        $this->PatentNumber = $PatentNumber;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(?string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescript(): ?string
    {
        return $this->Descript;
    }

    public function setDescript(?string $Descript): static
    {
        $this->Descript = $Descript;

        return $this;
    }

    public function getPatentsAreCategorized(): ?Category
    {
        return $this->PatentsAreCategorized;
    }

    public function setPatentsAreCategorized(?Category $PatentsAreCategorized): static
    {
        $this->PatentsAreCategorized = $PatentsAreCategorized;

        return $this;
    }

    public function getPatentsHaveLocalization(): ?Localization
    {
        return $this->PatentsHaveLocalization;
    }

    public function setPatentsHaveLocalization(?Localization $PatentsHaveLocalization): static
    {
        $this->PatentsHaveLocalization = $PatentsHaveLocalization;

        return $this;
    }

    public function getPatentsHaveLanguage(): ?Language
    {
        return $this->PatentsHaveLanguage;
    }

    public function setPatentsHaveLanguage(?Language $PatentsHaveLanguage): static
    {
        $this->PatentsHaveLanguage = $PatentsHaveLanguage;

        return $this;
    }

    public function getPatentsHaveStatus(): ?Stats
    {
        return $this->PatentsHaveStatus;
    }

    public function setPatentsHaveStatus(?Stats $PatentsHaveStatus): static
    {
        $this->PatentsHaveStatus = $PatentsHaveStatus;

        return $this;
    }

    /**
     * @return Collection<int, PatentsToClassification>
     */
    public function getClassificationsList(): Collection
    {
        return $this->ClassificationsList;
    }

    public function addClassificationsList(PatentsToClassification $classificationsList): static
    {
        if (!$this->ClassificationsList->contains($classificationsList)) {
            $this->ClassificationsList->add($classificationsList);
            $classificationsList->setPatent($this);
        }

        return $this;
    }

    public function removeClassificationsList(PatentsToClassification $classificationsList): static
    {
        if ($this->ClassificationsList->removeElement($classificationsList)) {
            // set the owning side to null (unless already changed)
            if ($classificationsList->getPatent() === $this) {
                $classificationsList->setPatent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Claims>
     */
    public function getPatentsHaveClaims(): Collection
    {
        return $this->PatentsHaveClaims;
    }

    public function addPatentsHaveClaim(Claims $patentsHaveClaim): static
    {
        if (!$this->PatentsHaveClaims->contains($patentsHaveClaim)) {
            $this->PatentsHaveClaims->add($patentsHaveClaim);
            $patentsHaveClaim->setPatentID($this);
        }

        return $this;
    }

    public function removePatentsHaveClaim(Claims $patentsHaveClaim): static
    {
        if ($this->PatentsHaveClaims->removeElement($patentsHaveClaim)) {
            // set the owning side to null (unless already changed)
            if ($patentsHaveClaim->getPatentID() === $this) {
                $patentsHaveClaim->setPatentID(null);
            }
        }

        return $this;
    }

    public function getPatentHasBusinessType(): ?BusinessType
    {
        return $this->PatentHasBusinessType;
    }

    public function setPatentHasBusinessType(?BusinessType $PatentHasBusinessType): static
    {
        $this->PatentHasBusinessType = $PatentHasBusinessType;

        return $this;
    }

    /**
     * @return Collection<int, Dates>
     */
    public function getPatentsHaveDates(): Collection
    {
        return $this->PatentsHaveDates;
    }

    public function addPatentsHaveDate(Dates $patentsHaveDate): static
    {
        if (!$this->PatentsHaveDates->contains($patentsHaveDate)) {
            $this->PatentsHaveDates->add($patentsHaveDate);
            $patentsHaveDate->setPatentID($this);
        }

        return $this;
    }

    public function removePatentsHaveDate(Dates $patentsHaveDate): static
    {
        if ($this->PatentsHaveDates->removeElement($patentsHaveDate)) {
            // set the owning side to null (unless already changed)
            if ($patentsHaveDate->getPatentID() === $this) {
                $patentsHaveDate->setPatentID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventor>
     */
    public function getInventors(): Collection
    {
        return $this->Inventors;
    }

    public function addInventor(Inventor $inventor): static
    {
        if (!$this->Inventors->contains($inventor)) {
            $this->Inventors->add($inventor);
        }

        return $this;
    }

    public function removeInventor(Inventor $inventor): static
    {
        $this->Inventors->removeElement($inventor);

        return $this;
    }

}
