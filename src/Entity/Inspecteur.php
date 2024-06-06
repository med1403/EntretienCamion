<?php

namespace App\Entity;

use App\Repository\InspecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InspecteurRepository::class)]
class Inspecteur
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
     * @var Collection<int, Inspection>
     */
    #[ORM\OneToMany(targetEntity: Inspection::class, mappedBy: 'inspecteur')]
    private Collection $inspection;

    public function __construct()
    {
        $this->inspection = new ArrayCollection();
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
     * @return Collection<int, Inspection>
     */
    public function getInspection(): Collection
    {
        return $this->inspection;
    }

    public function addInspection(Inspection $inspection): static
    {
        if (!$this->inspection->contains($inspection)) {
            $this->inspection->add($inspection);
            $inspection->setInspecteur($this);
        }

        return $this;
    }

    public function removeInspection(Inspection $inspection): static
    {
        if ($this->inspection->removeElement($inspection)) {
            // set the owning side to null (unless already changed)
            if ($inspection->getInspecteur() === $this) {
                $inspection->setInspecteur(null);
            }
        }

        return $this;
    }
}
