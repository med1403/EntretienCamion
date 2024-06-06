<?php

namespace App\Entity;

use App\Repository\GraissageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GraissageRepository::class)]
class Graissage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'graissages')]
    private Collection $camion;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateGraissage = null;

    #[ORM\Column]
    private ?float $kmGraissage = null;

    #[ORM\Column]
    private ?float $ecartType = null;

    #[ORM\Column]
    private ?float $nbKmRestant = null;

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

    public function getDateGraissage(): ?\DateTimeInterface
    {
        return $this->dateGraissage;
    }

    public function setDateGraissage(\DateTimeInterface $dateGraissage): static
    {
        $this->dateGraissage = $dateGraissage;

        return $this;
    }

    public function getKmGraissage(): ?float
    {
        return $this->kmGraissage;
    }

    public function setKmGraissage(float $kmGraissage): static
    {
        $this->kmGraissage = $kmGraissage;

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

    public function getNbKmRestant(): ?float
    {
        return $this->nbKmRestant;
    }

    public function setNbKmRestant(float $nbKmRestant): static
    {
        $this->nbKmRestant = $nbKmRestant;

        return $this;
    }
}
