<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtiquetteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EtiquetteRepository::class)]
class Etiquette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'etiquettes')]
    private Collection $camion;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $etat = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $disponibilite = null;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;
        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    
}


// C'était les modifications que j'avais pporté
// #[ORM\Entity(repositoryClass: EtiquetteRepository::class)]
// class Etiquette
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column(type: 'integer')]
//     private ?int $id = null;

//     /**
//      * @var Collection<int, Camion>
//      */
//     #[ORM\ManyToMany(targetEntity: Camion::class, inversedBy: 'etiquettes')]
//     private Collection $camion;

//     #[ORM\Column(type: 'string', length: 255)]
//     private ?string $etat = null;

//     #[ORM\Column(type: 'string', length: 150)]
//     private ?string $disponibilite = null;

//     #[ORM\Column(length: 150)]
//     private ?string $statut = null;

//     public function __construct()
//     {
//         $this->camion = new ArrayCollection();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function setId(int $id): static
//     {
//         $this->id = $id;
//         return $this;
//     }

//     /**
//      * @return Collection<int, Camion>
//      */
//     public function getCamion(): Collection
//     {
//         return $this->camion;
//     }

//     public function addCamion(Camion $camion): static
//     {
//         if (!$this->camion->contains($camion)) {
//             $this->camion->add($camion);
//         }
//         return $this;
//     }

//     public function removeCamion(Camion $camion): static
//     {
//         $this->camion->removeElement($camion);
//         return $this;
//     }

//     public function getEtat(): ?string
//     {
//         return $this->etat;
//     }

//     public function setEtat(string $etat): static
//     {
//         $this->etat = $etat;
//         return $this;
//     }

//     public function getDisponibilite(): ?String
//     {
//         return $this->disponibilite;
//     }

//     public function setDisponibilite(String $disponibilite): static
//     {
//         $this->disponibilite = $disponibilite;
//         return $this;
//     }

//     public function getStatut(): ?string
//     {
//         return $this->statut;
//     }

//     public function setStatut(string $statut): static
//     {
//         $this->statut = $statut;

//         return $this;
//     }
// }
