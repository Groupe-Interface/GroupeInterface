<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
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
    private $titleAvis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionAvis;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAvis;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleAvis(): ?string
    {
        return $this->titleAvis;
    }

    public function setTitleAvis(string $titleAvis): self
    {
        $this->titleAvis = $titleAvis;

        return $this;
    }

    public function getDescriptionAvis(): ?string
    {
        return $this->descriptionAvis;
    }

    public function setDescriptionAvis(string $descriptionAvis): self
    {
        $this->descriptionAvis = $descriptionAvis;

        return $this;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->dateAvis;
    }

    public function setDateAvis(\DateTimeInterface $dateAvis): self
    {
        $this->dateAvis = $dateAvis;

        return $this;
    }



}
