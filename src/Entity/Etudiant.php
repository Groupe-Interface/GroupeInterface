<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant extends User
{


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numPassport;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomEtudiant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payeNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payeEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailEtudiant;

    /**
     * @ORM\Column(type="integer")
     */
    private $phoneEtudiant;

    /**
     * @ORM\Column(type="integer")
     */
    private $phonoUrgence;

    /**
     * @ORM\Column(type="date")
     */
    private $session;

    /**
     * @ORM\ManyToMany(targetEntity=Semestre::class, mappedBy="idUser")
     */
    private $semestres;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="idEtudiant")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Abscence::class, mappedBy="idEtudiant")
     */
    private $abscences;

    public function __construct()
    {
        parent::__construct();
        $this->semestres = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->abscences = new ArrayCollection();
    }



    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNumPassport(): ?int
    {
        return $this->numPassport;
    }

    public function setNumPassport(?int $numPassport): self
    {
        $this->numPassport = $numPassport;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(?int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(string $nomEtudiant): self
    {
        $this->nomEtudiant = $nomEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(string $prenomEtudiant): self
    {
        $this->prenomEtudiant = $prenomEtudiant;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getPayeNaiss(): ?string
    {
        return $this->payeNaiss;
    }

    public function setPayeNaiss(string $payeNaiss): self
    {
        $this->payeNaiss = $payeNaiss;

        return $this;
    }

    public function getPayeEtudiant(): ?string
    {
        return $this->payeEtudiant;
    }

    public function setPayeEtudiant(string $payeEtudiant): self
    {
        $this->payeEtudiant = $payeEtudiant;

        return $this;
    }

    public function getVilleEtudiant(): ?string
    {
        return $this->villeEtudiant;
    }

    public function setVilleEtudiant(string $villeEtudiant): self
    {
        $this->villeEtudiant = $villeEtudiant;

        return $this;
    }

    public function getPhotoEtudiant(): ?string
    {
        return $this->photoEtudiant;
    }

    public function setPhotoEtudiant(string $photoEtudiant): self
    {
        $this->photoEtudiant = $photoEtudiant;

        return $this;
    }

    public function getEmailEtudiant(): ?string
    {
        return $this->emailEtudiant;
    }

    public function setEmailEtudiant(string $emailEtudiant): self
    {
        $this->emailEtudiant = $emailEtudiant;

        return $this;
    }

    public function getPhoneEtudiant(): ?int
    {
        return $this->phoneEtudiant;
    }

    public function setPhoneEtudiant(int $phoneEtudiant): self
    {
        $this->phoneEtudiant = $phoneEtudiant;

        return $this;
    }

    public function getPhonoUrgence(): ?int
    {
        return $this->phonoUrgence;
    }

    public function setPhonoUrgence(int $phonoUrgence): self
    {
        $this->phonoUrgence = $phonoUrgence;

        return $this;
    }

    public function getSession(): ?\DateTimeInterface
    {
        return $this->session;
    }

    public function setSession(\DateTimeInterface $session): self
    {
        $this->session = $session;

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
            $semestre->addIdUser($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->removeElement($semestre)) {
            $semestre->removeIdUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setIdEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getIdEtudiant() === $this) {
                $note->setIdEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Abscence[]
     */
    public function getAbscences(): Collection
    {
        return $this->abscences;
    }

    public function addAbscence(Abscence $abscence): self
    {
        if (!$this->abscences->contains($abscence)) {
            $this->abscences[] = $abscence;
            $abscence->setIdEtudiant($this);
        }

        return $this;
    }

    public function removeAbscence(Abscence $abscence): self
    {
        if ($this->abscences->removeElement($abscence)) {
            // set the owning side to null (unless already changed)
            if ($abscence->getIdEtudiant() === $this) {
                $abscence->setIdEtudiant(null);
            }
        }

        return $this;
    }
}
