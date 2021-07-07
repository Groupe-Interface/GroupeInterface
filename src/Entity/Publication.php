<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
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
    private $descriptionPublication;

    /**
     * @ORM\Column(type="date")
     */
    private $datePublication;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbComment;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbVue;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="publications")
     */
    private $idCours;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publications")
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="idPublication")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionPublication(): ?string
    {
        return $this->descriptionPublication;
    }

    public function setDescriptionPublication(string $descriptionPublication): self
    {
        $this->descriptionPublication = $descriptionPublication;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getNbComment(): ?int
    {
        return $this->nbComment;
    }

    public function setNbComment(int $nbComment): self
    {
        $this->nbComment = $nbComment;

        return $this;
    }

    public function getNbVue(): ?int
    {
        return $this->nbVue;
    }

    public function setNbVue(int $nbVue): self
    {
        $this->nbVue = $nbVue;

        return $this;
    }

    public function getIdCours(): ?Cours
    {
        return $this->idCours;
    }

    public function setIdCours(?Cours $idCours): self
    {
        $this->idCours = $idCours;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdPublication($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdPublication() === $this) {
                $commentaire->setIdPublication(null);
            }
        }

        return $this;
    }
}
