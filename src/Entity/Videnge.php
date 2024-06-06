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

    /**
     * @var Collection<int, ListPiece>
     */
    #[ORM\ManyToMany(targetEntity: ListPiece::class, inversedBy: 'videnges')]
    private Collection $listPiece;

    #[ORM\Column]
    private ?float $kmVidenge = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?GradeVidenge $gradeVidenge = null;

    #[ORM\Column]
    private ?float $ecartType = null;

    public function __construct()
    {
        $this->camion = new ArrayCollection();
        $this->listPiece = new ArrayCollection();
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

    /**
     * @return Collection<int, ListPiece>
     */
    public function getListPiece(): Collection
    {
        return $this->listPiece;
    }

    public function addListPiece(ListPiece $listPiece): static
    {
        if (!$this->listPiece->contains($listPiece)) {
            $this->listPiece->add($listPiece);
        }

        return $this;
    }

    public function removeListPiece(ListPiece $listPiece): static
    {
        $this->listPiece->removeElement($listPiece);

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
}
