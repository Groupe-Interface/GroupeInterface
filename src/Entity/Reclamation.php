<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
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
    private $titleReclamation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionReclamation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateReclamation;




    protected $captchaCode;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="reclamation")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    /**
     * @param mixed $captchaCode
     * @return Reclamation
     */
    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleReclamation(): ?string
    {
        return $this->titleReclamation;
    }

    public function setTitleReclamation(string $titleReclamation): self
    {
        $this->titleReclamation = $titleReclamation;

        return $this;
    }

    public function getDescriptionReclamation(): ?string
    {
        return $this->descriptionReclamation;
    }

    public function setDescriptionReclamation(string $descriptionReclamation): self
    {
        $this->descriptionReclamation = $descriptionReclamation;

        return $this;
    }

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->dateReclamation;
    }

    public function setDateReclamation(\DateTimeInterface $dateReclamation): self
    {
        $this->dateReclamation = $dateReclamation;

        return $this;
    }
    public function __toString()
    {
        return $this->titleReclamation;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
