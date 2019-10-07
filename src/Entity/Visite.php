<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $suite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Visiteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Bien;

    /**
     * @ORM\Column(type="integer")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuite(): ?string
    {
        return $this->suite;
    }

    public function setSuite(string $suite): self
    {
        $this->suite = $suite;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->Visiteur;
    }

    public function setVisiteur(?Visiteur $Visiteur): self
    {
        $this->Visiteur = $Visiteur;

        return $this;
    }

    public function getBien(): ?Bien
    {
        return $this->Bien;
    }

    public function setBien(?Bien $Bien): self
    {
        $this->Bien = $Bien;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }
}
