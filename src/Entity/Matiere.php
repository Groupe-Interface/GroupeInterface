<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
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
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="matieres")
     */
    private $idEnseignant;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="matieres")
     */
    private $idSpecialite;

    /**
     * @ORM\ManyToOne(targetEntity=Note::class, inversedBy="idMatiere")
     */
    private $note;

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

    public function getIdEnseignant(): ?Enseignant
    {
        return $this->idEnseignant;
    }

    public function setIdEnseignant(?Enseignant $idEnseignant): self
    {
        $this->idEnseignant = $idEnseignant;

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

    public function getNote(): ?Note
    {
        return $this->note;
    }

    public function setNote(?Note $note): self
    {
        $this->note = $note;

        return $this;
    }
}
