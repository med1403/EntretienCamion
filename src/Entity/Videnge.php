<?php

namespace App\Entity;

use App\Repository\VidengeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VidengeRepository::class)]
class Videnge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'videnges')]
    private Collection $camion;

    #[ORM\Column]
    private ?float $kmVidenge = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?GradeVidenge $gradeVidenge = null;

    #[ORM\Column]
    private ?float $ecartType = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ListPiece $listPiece = null;

    public function __construct()
    {
        $this->camion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, Camion>
     */
    public function getCamion(): Collection
    {
        return $this->camion;
    }

    public function addCamion(Camion $camion): static
    {
        if (!$this->camion->contains($camion)) {
            $this->camion->add($camion);
        }

        return $this;
    }

    public function removeCamion(Camion $camion): static
    {
        $this->camion->removeElement($camion);

        return $this;
    }

    public function getKmVidenge(): ?float
    {
        return $this->kmVidenge;
    }

    public function setKmVidenge(float $kmVidenge): static
    {
        $this->kmVidenge = $kmVidenge;

        return $this;
    }

    public function getGradeVidenge(): ?GradeVidenge
    {
        return $this->gradeVidenge;
    }

    public function setGradeVidenge(?GradeVidenge $gradeVidenge): static
    {
        $this->gradeVidenge = $gradeVidenge;

        return $this;
    }

    public function getEcartType(): ?float
    {
        return $this->ecartType;
    }

    public function setEcartType(float $ecartType): static
    {
        $this->ecartType = $ecartType;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getListPiece(): ?ListPiece
    {
        return $this->listPiece;
    }

    public function setListPiece(?ListPiece $listPiece): static
    {
        $this->listPiece = $listPiece;

        return $this;
    }
}
