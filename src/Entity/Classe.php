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
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="classes")
     */
    private $idSpecialite;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="idClasse")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="classe")
     */
    private $etudiant;

    /**
     * @ORM\ManyToMany(targetEntity=Enseignant::class, mappedBy="classe")
     */
    private $enseignants;




    public function __construct()
    {

        $this->cours = new ArrayCollection();
        $this->etudiant = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
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

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
            $etudiant->setClasse($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getClasse() === $this) {
                $etudiant->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants[] = $enseignant;
            $enseignant->addClasse($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            $enseignant->removeClasse($this);
        }

        return $this;
    }

}
