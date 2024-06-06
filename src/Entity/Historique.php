<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Chauffeur>
     */
    #[ORM\ManyToMany(targetEntity: Chauffeur::class, inversedBy: 'historiques')]
    private Collection $personnel;

    #[ORM\Column(length: 50)]
    private ?string $typePersonnel = null;

    public function __construct()
    {
        $this->personnel = new ArrayCollection();
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
     * @return Collection<int, Chauffeur>
     */
    public function getPersonnel(): Collection
    {
        return $this->personnel;
    }

    public function addPersonnel(Chauffeur $personnel): static
    {
        if (!$this->personnel->contains($personnel)) {
            $this->personnel->add($personnel);
        }

        return $this;
    }

    public function removePersonnel(Chauffeur $personnel): static
    {
        $this->personnel->removeElement($personnel);

        return $this;
    }

    public function getTypePersonnel(): ?string
    {
        return $this->typePersonnel;
    }

    public function setTypePersonnel(string $typePersonnel): static
    {
        $this->typePersonnel = $typePersonnel;

        return $this;
    }
}
