<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\OneToMany(targetEntity: Camion::class, mappedBy: 'categorie')]
    private Collection $camions;

    public function __construct()
    {
        $this->camions = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Camion>
     */
    public function getCamions(): Collection
    {
        return $this->camions;
    }

    public function addCamion(Camion $camion): static
    {
        if (!$this->camions->contains($camion)) {
            $this->camions->add($camion);
            $camion->setCategorie($this);
        }

        return $this;
    }

    public function removeCamion(Camion $camion): static
    {
        if ($this->camions->removeElement($camion)) {
            // set the owning side to null (unless already changed)
            if ($camion->getCategorie() === $this) {
                $camion->setCategorie(null);
            }
        }

        return $this;
    }
}
