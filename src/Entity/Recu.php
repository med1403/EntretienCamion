<?php

namespace App\Entity;

use App\Repository\RecuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecuRepository::class)]
class Recu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Vendeur>
     */
    #[ORM\ManyToMany(targetEntity: Vendeur::class, inversedBy: 'recus')]
    private Collection $vendeur;

    /**
     * @var Collection<int, Acheteur>
     */
    #[ORM\ManyToMany(targetEntity: Acheteur::class, inversedBy: 'recus')]
    private Collection $acheteur;

    #[ORM\Column(length: 50)]
    private ?string $imageRecu = null;

    public function __construct()
    {
        $this->vendeur = new ArrayCollection();
        $this->acheteur = new ArrayCollection();
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
     * @return Collection<int, Vendeur>
     */
    public function getVendeur(): Collection
    {
        return $this->vendeur;
    }

    public function addVendeur(Vendeur $vendeur): static
    {
        if (!$this->vendeur->contains($vendeur)) {
            $this->vendeur->add($vendeur);
        }

        return $this;
    }

    public function removeVendeur(Vendeur $vendeur): static
    {
        $this->vendeur->removeElement($vendeur);

        return $this;
    }

    /**
     * @return Collection<int, Acheteur>
     */
    public function getAcheteur(): Collection
    {
        return $this->acheteur;
    }

    public function addAcheteur(Acheteur $acheteur): static
    {
        if (!$this->acheteur->contains($acheteur)) {
            $this->acheteur->add($acheteur);
        }

        return $this;
    }

    public function removeAcheteur(Acheteur $acheteur): static
    {
        $this->acheteur->removeElement($acheteur);

        return $this;
    }

    public function getImageRecu(): ?string
    {
        return $this->imageRecu;
    }

    public function setImageRecu(string $imageRecu): static
    {
        $this->imageRecu = $imageRecu;

        return $this;
    }
}
