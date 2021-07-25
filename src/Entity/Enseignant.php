<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant
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
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="enseignants")
     */
    private $matiere;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, inversedBy="enseignants")
     */
    private $classe;






    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->classe = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe[] = $classe;
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        $this->classe->removeElement($classe);

        return $this;
    }

    public function __toString()
    {
        return $this->nomEnseignant."  ".$this->prenomEnseignant;
    }



}
