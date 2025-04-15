<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

// When storing patent information to our database, users may also have files associated with the patent they may want to store for easy access
// This database entity stores the unique filename which is generated when the file is uploaded
// The file is stored in the /public/uploads directory and can be retrieved using the Filename field

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Clean unique filename given by PHP when file is created
    // This filename is the name of the file stored on the server, not the original name of the file
    #[ORM\Column(length: 255)]
    private ?string $Filename = null;

    // A patent can have many files, a file has one patent
    // For ease of use, the File entity should be able to see the patent entity it is associated with
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
