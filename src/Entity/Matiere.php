<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
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
    private $nomMatiere;

    /**
     * @ORM\Column(type="float")
     */
    private $moyenneMatiere;

    /**
     * @ORM\Column(type="float")
     */
    private $coeffMatiere;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="matieres")
     */
    private $idSpecialite;


    /**
     * @ORM\Column(type="float")
     */
    private $noteExamen;

    /**
     * @ORM\Column(type="float")
     */
    private $noteTest;

    /**
     * @ORM\ManyToMany(targetEntity=Etudiant::class, mappedBy="matiere")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="matiere")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=Enseignant::class, mappedBy="matiere")
     */
    private $enseignants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getMoyenneMatiere(): ?float
    {
        return $this->moyenneMatiere;
    }

    public function setMoyenneMatiere(float $moyenneMatiere): self
    {
        $this->moyenneMatiere = $moyenneMatiere;

        return $this;
    }

    public function getCoeffMatiere(): ?float
    {
        return $this->coeffMatiere;
    }

    public function setCoeffMatiere(float $coeffMatiere): self
    {
        $this->coeffMatiere = $coeffMatiere;

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

    public function getNoteExamen(): ?float
    {
        return $this->noteExamen;
    }

    public function setNoteExamen(float $noteExamen): self
    {
        $this->noteExamen = $noteExamen;

        return $this;
    }

    public function getNoteTest(): ?float
    {
        return $this->noteTest;
    }

    public function setNoteTest(float $noteTest): self
    {
        $this->noteTest = $noteTest;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->addMatiere($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            $etudiant->removeMatiere($this);
        }

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
            $cour->setMatiere($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getMatiere() === $this) {
                $cour->setMatiere(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nomMatiere;
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
            $enseignant->setMatiere($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getMatiere() === $this) {
                $enseignant->setMatiere(null);
            }
        }

        return $this;
    }
}
