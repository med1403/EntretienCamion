<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $marque = null;

    #[ORM\Column(length: 50)]
    private ?string $nbReference = null;

    #[ORM\Column]
    private ?float $prix_unitaire = null;

    /**
     * @var Collection<int, ListPiece>
     */
    #[ORM\ManyToMany(targetEntity: ListPiece::class, mappedBy: 'piece')]
    private Collection $listPieces;

    public function __construct()
    {
        $this->listPieces = new ArrayCollection();
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

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getNbReference(): ?string
    {
        return $this->nbReference;
    }

    public function setNbReference(string $nbReference): static
    {
        $this->nbReference = $nbReference;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): static
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    /**
     * @return Collection<int, ListPiece>
     */
    public function getListPieces(): Collection
    {
        return $this->listPieces;
    }

    public function addListPiece(ListPiece $listPiece): static
    {
        if (!$this->listPieces->contains($listPiece)) {
            $this->listPieces->add($listPiece);
            $listPiece->addPiece($this);
        }

        return $this;
    }

    public function removeListPiece(ListPiece $listPiece): static
    {
        if ($this->listPieces->removeElement($listPiece)) {
            $listPiece->removePiece($this);
        }

        return $this;
    }
}
