<?php

namespace App\Entity;

use App\Repository\HistoriqueCamionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueCamionRepository::class)]
class HistoriqueCamion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'historiqueCamions')]
    private Collection $camion;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSuppression = null;

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

    public function getDateSuppression(): ?\DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(\DateTimeInterface $dateSuppression): static
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }
}
