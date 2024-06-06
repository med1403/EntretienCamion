<?php

namespace App\Entity;

use App\Repository\ChecklistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChecklistRepository::class)]
class Checklist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'checklists')]
    private ?Camion $camion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateChecklist = null;

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

    public function getDateChecklist(): ?\DateTimeInterface
    {
        return $this->dateChecklist;
    }

    public function setDateChecklist(\DateTimeInterface $dateChecklist): static
    {
        $this->dateChecklist = $dateChecklist;

        return $this;
    }
}
