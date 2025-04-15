<?php

namespace App\Entity;

use App\Repository\PersonTypeRepository;
use Doctrine\ORM\Mapping as ORM;

// Note: an Inventor is simply a user. An Inventor does not have to have the 'Inventor' PersonType.
// Users should not worry that they are called Inventors, this is simply a name for the entity.

// This is used to store what type of person the user is,
// for statistical purposes at this stage of the project.
// In the future, there would be a practical use for this entity as a user's experience would be defined
// based on their person type, Inventors would likely have the default experience while Attorneys would have access
// to their client's patents, system administrators would have access to everything, etc.

// Each Inventor has one PersonType, a PersonType can have many Inventors

// This entity is autofilled in the migrations

#[ORM\Entity(repositoryClass: PersonTypeRepository::class)]
class PersonType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 63)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
