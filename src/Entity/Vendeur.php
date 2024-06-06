<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendeurRepository::class)]
class Vendeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $contact = null;

    /**
     * @var Collection<int, Recu>
     */
    #[ORM\ManyToMany(targetEntity: Recu::class, mappedBy: 'vendeur')]
    private Collection $recus;

    public function __construct()
    {
        $this->recus = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection<int, Recu>
     */
    public function getRecus(): Collection
    {
        return $this->recus;
    }

    public function addRecu(Recu $recu): static
    {
        if (!$this->recus->contains($recu)) {
            $this->recus->add($recu);
            $recu->addVendeur($this);
        }

        return $this;
    }

    public function removeRecu(Recu $recu): static
    {
        if ($this->recus->removeElement($recu)) {
            $recu->removeVendeur($this);
        }

        return $this;
    }
}
