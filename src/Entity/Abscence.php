<?php

namespace App\Entity;

use App\Repository\AbscenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbscenceRepository::class)
 */
class Abscence
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
    private $justifee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaireAbscence;

    /**
     * @ORM\ManyToOne(targetEntity=Seance::class, inversedBy="abscences")
     */
    private $idSeance;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="abscences")
     */
    private $idEtudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJustifee(): ?bool
    {
        return $this->justifee;
    }

    public function setJustifee(bool $justifee): self
    {
        $this->justifee = $justifee;

        return $this;
    }

    public function getCommentaireAbscence(): ?string
    {
        return $this->commentaireAbscence;
    }

    public function setCommentaireAbscence(string $commentaireAbscence): self
    {
        $this->commentaireAbscence = $commentaireAbscence;

        return $this;
    }

    public function getIdSeance(): ?Seance
    {
        return $this->idSeance;
    }

    public function setIdSeance(?Seance $idSeance): self
    {
        $this->idSeance = $idSeance;

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
}
