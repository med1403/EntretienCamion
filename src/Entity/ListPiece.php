<?php

namespace App\Entity;

use App\Repository\ListPieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListPieceRepository::class)]
class ListPiece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\ManyToMany(targetEntity: Piece::class, inversedBy: 'listPieces')]
    private Collection $piece;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $prix_total = null;

    /**
     * @var Collection<int, Videnge>
     */
    #[ORM\ManyToMany(targetEntity: Videnge::class, mappedBy: 'listPiece')]
    private Collection $videnges;

    public function __construct()
    {
        $this->piece = new ArrayCollection();
        $this->videnges = new ArrayCollection();
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
     * @return Collection<int, Piece>
     */
    public function getPiece(): Collection
    {
        return $this->piece;
    }

    public function addPiece(Piece $piece): static
    {
        if (!$this->piece->contains($piece)) {
            $this->piece->add($piece);
        }

        return $this;
    }

    public function removePiece(Piece $piece): static
    {
        $this->piece->removeElement($piece);

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prix_total;
    }

    public function setPrixTotal(float $prix_total): static
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    /**
     * @return Collection<int, Videnge>
     */
    public function getVidenges(): Collection
    {
        return $this->videnges;
    }

    public function addVidenge(Videnge $videnge): static
    {
        if (!$this->videnges->contains($videnge)) {
            $this->videnges->add($videnge);
            $videnge->addListPiece($this);
        }

        return $this;
    }

    public function removeVidenge(Videnge $videnge): static
    {
        if ($this->videnges->removeElement($videnge)) {
            $videnge->removeListPiece($this);
        }

        return $this;
    }
}
