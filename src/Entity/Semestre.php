<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $payementSemestre;

    /**
     * @ORM\ManyToMany(targetEntity=Etudiant::class, inversedBy="semestres")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="semestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSpecialite;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayementSemestre(): ?bool
    {
        return $this->payementSemestre;
    }

    public function setPayementSemestre(bool $payementSemestre): self
    {
        $this->payementSemestre = $payementSemestre;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(Etudiant $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
        }

        return $this;
    }

    public function removeIdUser(Etudiant $idUser): self
    {
        $this->idUser->removeElement($idUser);

        return $this;
    }

    public function getIdSpecialite(): ?Specialite
    {
        return $this->idSpecialite;
    }

    public function setIdSpecialite(?Specialite $idSpecialite): self
    {
        $this->idSpecialite = $idSpecialite;

        return $this;
    }
}
