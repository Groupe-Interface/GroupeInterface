<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin extends User
{


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailAdmin;





    public function getNomAdmin(): ?string
    {
        return $this->nomAdmin;
    }

    public function setNomAdmin(string $nomAdmin): self
    {
        $this->nomAdmin = $nomAdmin;

        return $this;
    }

    public function getPrenomAdmin(): ?string
    {
        return $this->prenomAdmin;
    }

    public function setPrenomAdmin(string $prenomAdmin): self
    {
        $this->prenomAdmin = $prenomAdmin;

        return $this;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->emailAdmin;
    }

    public function setEmailAdmin(string $emailAdmin): self
    {
        $this->emailAdmin = $emailAdmin;

        return $this;
    }





}
