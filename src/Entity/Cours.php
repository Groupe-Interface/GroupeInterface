<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
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
    private $supportCours;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="cours")
     */
    private $idClasse;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="idCours")
     */
    private $publications;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCours;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCours;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="cours")
     */
    private $matiere;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupportCours()
    {
        return $this->supportCours;
    }

    public function setSupportCours( $supportCours): self
    {
        $this->supportCours = $supportCours;

        return $this;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->idClasse;
    }

    public function setIdClasse(?Classe $idClasse): self
    {
        $this->idClasse = $idClasse;

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->setIdCours($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getIdCours() === $this) {
                $publication->setIdCours(null);
            }
        }

        return $this;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): self
    {
        $this->nomCours = $nomCours;

        return $this;
    }
    public function __toString()
    {
        return $this->nomCours;
    }

    public function getDateCours(): ?\DateTimeInterface
    {
        return $this->DateCours;
    }

    public function setDateCours(\DateTimeInterface $DateCours): self
    {
        $this->DateCours = $DateCours;

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
