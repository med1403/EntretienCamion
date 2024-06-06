<?php

namespace App\Entity;

use App\Repository\IncidenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenceRepository::class)]
class Incidence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'incidences')]
    private Collection $camion;

    #[ORM\Column(length: 30)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
