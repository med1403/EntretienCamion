<?php

namespace App\Entity;

use App\Repository\CamionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CamionRepository::class)]
class Camion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'camions')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'camions')]
    private ?TypeCamion $typeCamion = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Tracteur $tracteur = null;

    #[ORM\Column(length: 50)]
    private ?string $remorque = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateIntegration = null;

    #[ORM\Column(length: 50)]
    private ?string $location = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $observation = null;

    #[ORM\Column]
    private ?float $kmActuel = null;

    /**
     * @var Collection<int, Tracabilite>
     */
    #[ORM\ManyToMany(targetEntity: Tracabilite::class, mappedBy: 'camion')]
    private Collection $tracabilites;

    /**
     * @var Collection<int, Graissage>
     */
    #[ORM\ManyToMany(targetEntity: Graissage::class, mappedBy: 'camion')]
    private Collection $graissages;

    /**
     * @var Collection<int, Checklist>
     */
    #[ORM\OneToMany(targetEntity: Checklist::class, mappedBy: 'camion')]
    private Collection $checklists;

    /**
     * @var Collection<int, Etiquette>
     */
    #[ORM\ManyToMany(targetEntity: Etiquette::class, mappedBy: 'camion')]
    private Collection $etiquettes;

    /**
     * @var Collection<int, Incidence>
     */
    #[ORM\ManyToMany(targetEntity: Incidence::class, mappedBy: 'camion')]
    private Collection $incidences;

    #[ORM\ManyToOne(inversedBy: 'camion')]
    private ?Inspection $inspection = null;

    /**
     * @var Collection<int, Videnge>
     */
    #[ORM\ManyToMany(targetEntity: Videnge::class, mappedBy: 'camion')]
    private Collection $videnges;

    /**
     * @var Collection<int, HistoriqueCamion>
     */
    #[ORM\ManyToMany(targetEntity: HistoriqueCamion::class, mappedBy: 'camion')]
    private Collection $historiqueCamions;

    public function __construct()
    {
        $this->tracabilites = new ArrayCollection();
        $this->graissages = new ArrayCollection();
        $this->checklists = new ArrayCollection();
        $this->etiquettes = new ArrayCollection();
        $this->incidences = new ArrayCollection();
        $this->videnges = new ArrayCollection();
        $this->historiqueCamions = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTypeCamion(): ?TypeCamion
    {
        return $this->typeCamion;
    }

    public function setTypeCamion(?TypeCamion $typeCamion): static
    {
        $this->typeCamion = $typeCamion;

        return $this;
    }

    public function getTracteur(): ?Tracteur
    {
        return $this->tracteur;
    }

    public function setTracteur(?Tracteur $tracteur): static
    {
        $this->tracteur = $tracteur;

        return $this;
    }

    public function getRemorque(): ?string
    {
        return $this->remorque;
    }

    public function setRemorque(string $remorque): static
    {
        $this->remorque = $remorque;

        return $this;
    }

    public function getDateIntegration(): ?\DateTimeInterface
    {
        return $this->dateIntegration;
    }

    public function setDateIntegration(\DateTimeInterface $dateIntegration): static
    {
        $this->dateIntegration = $dateIntegration;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    public function getKmActuel(): ?float
    {
        return $this->kmActuel;
    }

    public function setKmActuel(float $kmActuel): static
    {
        $this->kmActuel = $kmActuel;

        return $this;
    }

    /**
     * @return Collection<int, Tracabilite>
     */
    public function getTracabilites(): Collection
    {
        return $this->tracabilites;
    }

    public function addTracabilite(Tracabilite $tracabilite): static
    {
        if (!$this->tracabilites->contains($tracabilite)) {
            $this->tracabilites->add($tracabilite);
            $tracabilite->addCamion($this);
        }

        return $this;
    }

    public function removeTracabilite(Tracabilite $tracabilite): static
    {
        if ($this->tracabilites->removeElement($tracabilite)) {
            $tracabilite->removeCamion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Graissage>
     */
    public function getGraissages(): Collection
    {
        return $this->graissages;
    }

    public function addGraissage(Graissage $graissage): static
    {
        if (!$this->graissages->contains($graissage)) {
            $this->graissages->add($graissage);
            $graissage->addCamion($this);
        }

        return $this;
    }

    public function removeGraissage(Graissage $graissage): static
    {
        if ($this->graissages->removeElement($graissage)) {
            $graissage->removeCamion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Checklist>
     */
    public function getChecklists(): Collection
    {
        return $this->checklists;
    }

    public function addChecklist(Checklist $checklist): static
    {
        if (!$this->checklists->contains($checklist)) {
            $this->checklists->add($checklist);
            $checklist->setCamion($this);
        }

        return $this;
    }

    public function removeChecklist(Checklist $checklist): static
    {
        if ($this->checklists->removeElement($checklist)) {
            // set the owning side to null (unless already changed)
            if ($checklist->getCamion() === $this) {
                $checklist->setCamion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etiquette>
     */
    public function getEtiquettes(): Collection
    {
        return $this->etiquettes;
    }

    public function addEtiquette(Etiquette $etiquette): static
    {
        if (!$this->etiquettes->contains($etiquette)) {
            $this->etiquettes->add($etiquette);
            $etiquette->addCamion($this);
        }

        return $this;
    }

    public function removeEtiquette(Etiquette $etiquette): static
    {
        if ($this->etiquettes->removeElement($etiquette)) {
            $etiquette->removeCamion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Incidence>
     */
    public function getIncidences(): Collection
    {
        return $this->incidences;
    }

    public function addIncidence(Incidence $incidence): static
    {
        if (!$this->incidences->contains($incidence)) {
            $this->incidences->add($incidence);
            $incidence->addCamion($this);
        }

        return $this;
    }

    public function removeIncidence(Incidence $incidence): static
    {
        if ($this->incidences->removeElement($incidence)) {
            $incidence->removeCamion($this);
        }

        return $this;
    }

    public function getInspection(): ?Inspection
    {
        return $this->inspection;
    }

    public function setInspection(?Inspection $inspection): static
    {
        $this->inspection = $inspection;

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
            $videnge->addCamion($this);
        }

        return $this;
    }

    public function removeVidenge(Videnge $videnge): static
    {
        if ($this->videnges->removeElement($videnge)) {
            $videnge->removeCamion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, HistoriqueCamion>
     */
    public function getHistoriqueCamions(): Collection
    {
        return $this->historiqueCamions;
    }

    public function addHistoriqueCamion(HistoriqueCamion $historiqueCamion): static
    {
        if (!$this->historiqueCamions->contains($historiqueCamion)) {
            $this->historiqueCamions->add($historiqueCamion);
            $historiqueCamion->addCamion($this);
        }

        return $this;
    }

    public function removeHistoriqueCamion(HistoriqueCamion $historiqueCamion): static
    {
        if ($this->historiqueCamions->removeElement($historiqueCamion)) {
            $historiqueCamion->removeCamion($this);
        }

        return $this;
    }
}
