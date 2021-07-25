<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
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
    private $payementSemestre;



    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="semestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSpecialite;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayementSemestre(): ?bool
    {
        return $this->payementSemestre;
    }

    public function setPayementSemestre(bool $payementSemestre): self
    {
        $this->payementSemestre = $payementSemestre;

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
}
