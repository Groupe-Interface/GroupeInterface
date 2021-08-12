<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $noteExamen;

    /**
     * @ORM\Column(type="float")
     */
    private $noteTest;

    /**
     * @ORM\Column(type="float")
     */
    private $moyenneNote;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="notes")
     */
    private $idEtudiant;

    /**
     * @ORM\OneToMany(targetEntity=Matiere::class, mappedBy="note")
     */
    private $idMatiere;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="notes")
     */
    private $matiere;

    public function __construct()
    {
        $this->idMatiere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMoyenneNote(): ?float
    {
        return $this->moyenneNote;
    }

    public function setMoyenneNote(float $moyenneNote): self
    {
        $this->moyenneNote = $moyenneNote;

        return $this;
    }

    public function getIdEtudiant(): ?Etudiant
    {
        return $this->idEtudiant;
    }

    public function setIdEtudiant(?Etudiant $idEtudiant): self
    {
        $this->idEtudiant = $idEtudiant;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getIdMatiere(): Collection
    {
        return $this->idMatiere;
    }

    public function addIdMatiere(Matiere $idMatiere): self
    {
        if (!$this->idMatiere->contains($idMatiere)) {
            $this->idMatiere[] = $idMatiere;
            $idMatiere->setNote($this);
        }

        return $this;
    }

    public function removeIdMatiere(Matiere $idMatiere): self
    {
        if ($this->idMatiere->removeElement($idMatiere)) {
            // set the owning side to null (unless already changed)
            if ($idMatiere->getNote() === $this) {
                $idMatiere->setNote(null);
            }
        }

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}
