<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
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
    private $nomSpecialite;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeSpecialite;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrSemestre;

    /**
     * @ORM\OneToMany(targetEntity=Semestre::class, mappedBy="idSpecialite")
     */
    private $semestres;

    /**
     * @ORM\OneToMany(targetEntity=Matiere::class, mappedBy="idSpecialite")
     */
    private $matieres;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="idSpecialite")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="specialites")
     */
    private $departement;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSpecialite(): ?string
    {
        return $this->nomSpecialite;
    }

    public function setNomSpecialite(string $nomSpecialite): self
    {
        $this->nomSpecialite = $nomSpecialite;

        return $this;
    }

    public function getDureeSpecialite(): ?int
    {
        return $this->dureeSpecialite;
    }

    public function setDureeSpecialite(int $dureeSpecialite): self
    {
        $this->dureeSpecialite = $dureeSpecialite;

        return $this;
    }

    public function getNbrSemestre(): ?int
    {
        return $this->nbrSemestre;
    }

    public function setNbrSemestre(int $nbrSemestre): self
    {
        $this->nbrSemestre = $nbrSemestre;

        return $this;
    }

    /**
     * @return Collection|Semestre[]
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    public function addSemestre(Semestre $semestre): self
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres[] = $semestre;
            $semestre->setIdSpecialite($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getIdSpecialite() === $this) {
                $semestre->setIdSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setIdSpecialite($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getIdSpecialite() === $this) {
                $matiere->setIdSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setIdSpecialite($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getIdSpecialite() === $this) {
                $class->setIdSpecialite(null);
            }
        }

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
    public function __toString()
    {
        return $this->nomSpecialite;
    }

}
