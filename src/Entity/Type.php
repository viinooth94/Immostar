<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_type;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdType(): ?int
    {
        return $this->id_type;
    }

    public function setIdType(int $id_type): self
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
