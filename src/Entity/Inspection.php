<?php

namespace App\Entity;

use App\Repository\InspectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InspectionRepository::class)]
class Inspection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Camion::class, inversedBy: 'inspections')]
    private ?Camion $camion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInspection = null;

    #[ORM\Column]
    private ?bool $resultat = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'inspection')]
    private ?Inspecteur $inspecteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCamion(): ?Camion
    {
        return $this->camion;
    }

    public function setCamion(?Camion $camion): static
    {
        $this->camion = $camion;

        return $this;
    }

    public function getDateInspection(): ?\DateTimeInterface
    {
        return $this->dateInspection;
    }

    public function setDateInspection(\DateTimeInterface $dateInspection): static
    {
        $this->dateInspection = $dateInspection;

        return $this;
    }

    public function isResultat(): ?bool
    {
        return $this->resultat;
    }

    public function setResultat(bool $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getInspecteur(): ?Inspecteur
    {
        return $this->inspecteur;
    }

    public function setInspecteur(?Inspecteur $inspecteur): static
    {
        $this->inspecteur = $inspecteur;

        return $this;
    }
}
