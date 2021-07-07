<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant extends User
{


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailEnseignant;

    /**
     * @ORM\Column(type="integer")
     */
    private $phoneEnseignant;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHeure;

    /**
     * @ORM\OneToMany(targetEntity=Matiere::class, mappedBy="idEnseignant")
     */
    private $matieres;

    public function __construct()
    {
        parent::__construct();
        $this->matieres = new ArrayCollection();
    }



    public function getNomEnseignant(): ?string
    {
        return $this->nomEnseignant;
    }

    public function setNomEnseignant(string $nomEnseignant): self
    {
        $this->nomEnseignant = $nomEnseignant;

        return $this;
    }

    public function getPrenomEnseignant(): ?string
    {
        return $this->prenomEnseignant;
    }

    public function setPrenomEnseignant(string $prenomEnseignant): self
    {
        $this->prenomEnseignant = $prenomEnseignant;

        return $this;
    }

    public function getAdresseEnseignant(): ?string
    {
        return $this->adresseEnseignant;
    }

    public function setAdresseEnseignant(string $adresseEnseignant): self
    {
        $this->adresseEnseignant = $adresseEnseignant;

        return $this;
    }

    public function getVilleEnseignant(): ?string
    {
        return $this->villeEnseignant;
    }

    public function setVilleEnseignant(string $villeEnseignant): self
    {
        $this->villeEnseignant = $villeEnseignant;

        return $this;
    }

    public function getEmailEnseignant(): ?string
    {
        return $this->emailEnseignant;
    }

    public function setEmailEnseignant(string $emailEnseignant): self
    {
        $this->emailEnseignant = $emailEnseignant;

        return $this;
    }

    public function getPhoneEnseignant(): ?int
    {
        return $this->phoneEnseignant;
    }

    public function setPhoneEnseignant(int $phoneEnseignant): self
    {
        $this->phoneEnseignant = $phoneEnseignant;

        return $this;
    }

    public function getPrixHeure(): ?float
    {
        return $this->prixHeure;
    }

    public function setPrixHeure(float $prixHeure): self
    {
        $this->prixHeure = $prixHeure;

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
            $matiere->setIdEnseignant($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getIdEnseignant() === $this) {
                $matiere->setIdEnseignant(null);
            }
        }

        return $this;
    }
}
