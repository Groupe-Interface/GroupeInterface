<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $descriptionCommentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCommentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="commentaires")
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="commentaires")
     */
    private $enseignant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionCommentaire(): ?string
    {
        return $this->descriptionCommentaire;
    }

    public function setDescriptionCommentaire(string $descriptionCommentaire): self
    {
        $this->descriptionCommentaire = $descriptionCommentaire;

        return $this;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->dateCommentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $dateCommentaire): self
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    public function setPublication(?Publication $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function __toString()
    {
        return $this->descriptionCommentaire;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }
}
