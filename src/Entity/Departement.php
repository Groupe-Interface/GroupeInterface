<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDepartement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abDepartement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDepartement(): ?string
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(string $nomDepartement): self
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    public function getAbDepartement(): ?string
    {
        return $this->abDepartement;
    }

    public function setAbDepartement(string $abDepartement): self
    {
        $this->abDepartement = $abDepartement;

        return $this;
    }
}
