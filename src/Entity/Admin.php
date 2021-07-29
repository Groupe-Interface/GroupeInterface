<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
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
    private $nom_admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdmin(): ?string
    {
        return $this->nom_admin;
    }

    public function setNomAdmin(string $nom_admin): self
    {
        $this->nom_admin = $nom_admin;

        return $this;
    }

    public function getPrenomAdmin(): ?string
    {
        return $this->prenom_admin;
    }

    public function setPrenomAdmin(string $prenom_admin): self
    {
        $this->prenom_admin = $prenom_admin;

        return $this;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->email_admin;
    }

    public function setEmailAdmin(string $email_admin): self
    {
        $this->email_admin = $email_admin;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
