<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauClasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $numClasse;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="classe")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="classes")
     */
    private $idSpecialite;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="idClasse")
     */
    private $cours;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveauClasse(): ?int
    {
        return $this->niveauClasse;
    }

    public function setNiveauClasse(int $niveauClasse): self
    {
        $this->niveauClasse = $niveauClasse;

        return $this;
    }

    public function getNumClasse(): ?int
    {
        return $this->numClasse;
    }

    public function setNumClasse(int $numClasse): self
    {
        $this->numClasse = $numClasse;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
            $idUser->setClasse($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->idUser->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getClasse() === $this) {
                $idUser->setClasse(null);
            }
        }

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

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setIdClasse($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getIdClasse() === $this) {
                $cour->setIdClasse(null);
            }
        }
        return $this;
    }
    public function __toString()
    {
        return $this->niveauClasse."_".$this->idSpecialite."_".$this->numClasse;
    }
}
